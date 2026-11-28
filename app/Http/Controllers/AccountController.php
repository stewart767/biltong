<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function dashboard(): View
    {
        $user = Auth::user();
        $recentOrders = Order::with('items')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $defaultAddress = $user->defaultAddress ?? $user->addresses()->first();
        $totalOrdersCount = Order::where('user_id', $user->id)->count();
        $totalSpent = Order::where('user_id', $user->id)->where('order_status', '!=', Order::STATUS_CANCELLED)->sum('total');

        return view('pages.account.dashboard', compact('user', 'recentOrders', 'defaultAddress', 'totalOrdersCount', 'totalSpent'));
    }

    public function orders(Request $request): View
    {
        $user = Auth::user();
        $query = Order::with(['items.product', 'delivery'])->where('user_id', $user->id);

        if ($search = $request->get('search')) {
            $query->where('order_number', 'like', "%{$search}%");
        }

        if ($status = $request->get('status')) {
            $query->where('order_status', $status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('pages.account.orders', compact('user', 'orders'));
    }

    public function orderDetail(string $orderNumber): View
    {
        $user = Auth::user();
        $order = Order::with(['items.product', 'payments', 'delivery'])
            ->where('user_id', $user->id)
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('pages.account.order-detail', compact('user', 'order'));
    }

    public function profile(): View
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('pages.account.profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:40',
            'company' => 'nullable|string|max:150',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = strtolower(trim($validated['email']));
        $user->phone = $validated['phone'];

        if (!empty($validated['new_password'])) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        if ($user->profile) {
            $user->profile->update([
                'phone' => $validated['phone'],
                'company' => $validated['company'] ?? null,
            ]);
        } else {
            $user->profile()->create([
                'phone' => $validated['phone'],
                'company' => $validated['company'] ?? null,
            ]);
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function addresses(): View
    {
        $user = Auth::user();
        $addresses = $user->addresses()->latest()->get();

        return view('pages.account.addresses', compact('user', 'addresses'));
    }

    public function storeAddress(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'recipient_name' => 'required|string|max:150',
            'phone' => 'required|string|max:40',
            'city' => 'required|string|max:100',
            'area' => 'required|string|max:100',
            'address_line' => 'required|string|max:500',
            'delivery_instructions' => 'nullable|string|max:500',
            'is_default' => 'nullable|boolean',
        ]);

        $isDefault = !empty($validated['is_default']) || $user->addresses()->count() === 0;

        if ($isDefault) {
            $user->addresses()->update(['is_default' => false]);
        }

        Address::create([
            'user_id' => $user->id,
            'label' => $validated['label'],
            'recipient_name' => $validated['recipient_name'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'area' => $validated['area'],
            'address_line' => $validated['address_line'],
            'delivery_instructions' => $validated['delivery_instructions'] ?? null,
            'is_default' => $isDefault,
        ]);

        return back()->with('success', 'Address added successfully.');
    }

    public function deleteAddress(int $id): RedirectResponse
    {
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->findOrFail($id);
        $wasDefault = $address->is_default;
        $address->delete();

        if ($wasDefault) {
            $next = $user->addresses()->first();
            if ($next) {
                $next->update(['is_default' => true]);
            }
        }

        return back()->with('success', 'Address removed.');
    }

    public function setDefaultAddress(int $id): RedirectResponse
    {
        $user = Auth::user();
        $user->addresses()->update(['is_default' => false]);
        $address = Address::where('user_id', $user->id)->findOrFail($id);
        $address->update(['is_default' => true]);

        return back()->with('success', 'Default address updated.');
    }
}
