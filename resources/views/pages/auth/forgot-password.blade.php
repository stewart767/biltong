@extends('layouts.app')

@section('title', 'Reset Password | COY BILTONG')

@section('content')

<div class="max-w-md mx-auto px-4 sm:px-6 py-16">
    <div class="bg-white p-8 sm:p-10 rounded-3xl border border-[#ECE2D2] shadow-sm">
        
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-[#171717] text-[#B77B3B] flex items-center justify-center mx-auto mb-3">
                <i data-lucide="key-round" class="w-6 h-6"></i>
            </div>
            <h1 class="font-display font-extrabold text-2xl text-[#171717]">Forgot Password?</h1>
            <p class="text-xs text-stone-500 mt-1">Enter your account email and we'll send you reset instructions.</p>
        </div>

        @if(session('status'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
            </div>

            <button type="submit" class="w-full py-4 bg-[#171717] hover:bg-[#B77B3B] text-white font-bold rounded-xl text-xs uppercase tracking-wider transition shadow-md">
                SEND RESET INSTRUCTIONS
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-[#ECE2D2] text-center text-xs text-stone-500">
            <a href="{{ route('login') }}" class="font-bold text-[#B77B3B] hover:underline">← Back to Sign In</a>
        </div>

    </div>
</div>

@endsection
