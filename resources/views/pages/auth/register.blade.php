@extends('layouts.app')

@section('title', 'Create an Account | COY BILTONG')

@section('content')

<div class="max-w-md mx-auto px-4 sm:px-6 py-16">
    <div class="bg-white p-8 sm:p-10 rounded-3xl border border-[#ECE2D2] shadow-sm">
        
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-[#171717] text-[#B77B3B] flex items-center justify-center mx-auto mb-3">
                <i data-lucide="user-plus" class="w-6 h-6"></i>
            </div>
            <h1 class="font-display font-extrabold text-2xl text-[#171717]">Create Your Account</h1>
            <p class="text-xs text-stone-500 mt-1">Enjoy faster checkout, saved delivery addresses and exclusive fresh batch alerts.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-xs text-red-700">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Email Address *</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Phone Number (M-Pesa/Mobile) *</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="+255 7XX XXX XXX" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Company / Office Name (Optional)</label>
                <input type="text" name="company" value="{{ old('company') }}" placeholder="e.g. Oysterbay Ventures" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Password (Min. 8 characters) *</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Confirm Password *</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <button type="submit" class="w-full py-4 bg-[#171717] hover:bg-[#B77B3B] text-white font-bold rounded-xl text-xs uppercase tracking-wider transition shadow-md">
                CREATE ACCOUNT
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-[#ECE2D2] text-center text-xs text-stone-500">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}" class="font-bold text-[#B77B3B] hover:underline ml-1">Sign In</a>
        </div>

    </div>
</div>

@endsection
