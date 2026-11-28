<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\CustomerProfile;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CustomerAuthController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }
        return view('pages.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Migrate session cart items to authenticated user
            $this->cartService->migrateSessionCartToUser(Auth::id());

            ActivityLog::log('customer_login', 'Customer logged in to account portal.');

            if (Auth::user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('account.dashboard'))->with('success', 'Welcome back to COY BILTONG!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }
        return view('pages.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email',
            'phone' => 'required|string|max:40',
            'password' => 'required|string|min:8|confirmed',
            'company' => 'nullable|string|max:150',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        CustomerProfile::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? null,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $this->cartService->migrateSessionCartToUser($user->id);

        ActivityLog::log('customer_registered', 'New customer account registered.');

        return redirect()->route('account.dashboard')->with('success', 'Your COY BILTONG account has been created successfully!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'You have been logged out.');
    }

    public function showForgotPassword(): View
    {
        return view('pages.auth.forgot-password');
    }

    public function forgotPassword(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Demonstration password reset link / notification
        return back()->with('status', 'We have sent password reset instructions to your email address.');
    }
}
