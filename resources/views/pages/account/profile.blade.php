@extends('layouts.app')

@section('title', 'My Profile | COY BILTONG')

@section('content')

<div class="bg-[#171717] text-white py-10 border-b border-[#262626]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-white">Account Settings</h1>
        <p class="text-xs text-stone-300 mt-1">Manage your name, contact phone, company affiliation and password.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-4 shadow-xs space-y-1">
                <a href="{{ route('account.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-stone-500"></i>
                    <span>Dashboard Overview</span>
                </a>
                <a href="{{ route('account.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="package" class="w-4 h-4 text-stone-500"></i>
                    <span>My Orders</span>
                </a>
                <a href="{{ route('account.addresses') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="map-pin" class="w-4 h-4 text-stone-500"></i>
                    <span>Delivery Addresses</span>
                </a>
                <a href="{{ route('account.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold bg-[#171717] text-white">
                    <i data-lucide="user" class="w-4 h-4 text-[#B77B3B]"></i>
                    <span>Account Profile</span>
                </a>
            </div>
        </div>

        <!-- Profile Update Form (9 cols) -->
        <div class="lg:col-span-9">
            <div class="bg-white p-8 rounded-3xl border border-[#ECE2D2] shadow-xs max-w-2xl">
                <h3 class="font-display font-bold text-xl text-[#171717] mb-6 pb-4 border-b border-[#ECE2D2]">
                    Profile Information
                </h3>

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-xs text-red-700 space-y-1">
                        @foreach($errors->all() as $err)
                            <p>{{ $err }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('account.profile.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Company / Organization (Optional)</label>
                        <input type="text" name="company" value="{{ old('company', $profile?->company) }}" placeholder="e.g. Oysterbay Tech" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                    </div>

                    <!-- Password Change -->
                    <div class="pt-6 border-t border-[#ECE2D2] space-y-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#68734B] block">Change Password (Leave blank to keep existing)</span>
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Current Password</label>
                            <input type="password" name="current_password" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">New Password</label>
                                <input type="password" name="new_password" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="px-8 py-3.5 bg-[#171717] hover:bg-[#B77B3B] text-white rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-md">
                        SAVE PROFILE
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
