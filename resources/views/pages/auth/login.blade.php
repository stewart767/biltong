@extends('layouts.app')

@section('title', 'Sign In | Customer Account | COY BILTONG')

@section('content')

<div class="max-w-md mx-auto px-4 sm:px-6 py-16">
    <div class="bg-white p-8 sm:p-10 rounded-3xl border border-[#ECE2D2] shadow-sm">
        
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-[#171717] text-[#B77B3B] flex items-center justify-center mx-auto mb-3">
                <i data-lucide="user" class="w-6 h-6"></i>
            </div>
            <h1 class="font-display font-extrabold text-2xl text-[#171717]">Sign In to Your Account</h1>
            <p class="text-xs text-stone-500 mt-1">Access your saved addresses, track current orders and view receipts.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-xs text-red-700">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Password</label>
                    <a href="{{ route('password.request') }}" class="text-xs text-[#B77B3B] hover:underline">Forgot password?</a>
                </div>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-[#B77B3B] rounded">
                    <span class="text-stone-600">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full py-4 bg-[#171717] hover:bg-[#B77B3B] text-white font-bold rounded-xl text-xs uppercase tracking-wider transition shadow-md">
                SIGN IN
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-[#ECE2D2] text-center text-xs text-stone-500">
            <span>Don't have an account yet?</span>
            <a href="{{ route('register') }}" class="font-bold text-[#B77B3B] hover:underline ml-1">Create an Account</a>
        </div>

    </div>
</div>

@endsection
