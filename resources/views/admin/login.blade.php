<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Burger House Operations</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php 
        $siteFavicon = \App\Models\SiteSetting::get('site_favicon'); 
        $siteLogo = \App\Models\SiteSetting::get('site_logo');
    @endphp
    @if($siteFavicon && file_exists(public_path($siteFavicon)))
        <link rel="icon" href="{{ asset($siteFavicon) }}">
    @endif
</head>
<body class="bg-[#141414] text-[#F5F5F5] font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md p-8 sm:p-10 rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] space-y-8 shadow-2xl">
        <div class="text-center space-y-3">
            @if($siteLogo && file_exists(public_path($siteLogo)))
                <img src="{{ asset($siteLogo) }}" alt="Burger House" class="h-16 w-auto mx-auto object-contain">
            @else
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center border-2 border-white/30 shadow-lg text-white">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                        <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                    </svg>
                </div>
            @endif
            <div>
                <span class="text-2xl font-black tracking-wider text-white block">BURGER HOUSE</span>
                <p class="text-xs text-[#E52E2E] font-bold uppercase tracking-widest mt-0.5">Kitchen & Operations Portal</p>
            </div>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-950/80 border-2 border-red-500/60 text-red-300 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300">Staff Email</label>
                <input type="email" name="email" value="{{ old('email', 'admin@burgerhouse.com') }}" required autofocus
                       class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-sm text-white focus:outline-none focus:border-[#E52E2E]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300">Password</label>
                <input type="password" name="password" value="password" required
                       class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-sm text-white focus:outline-none focus:border-[#E52E2E]">
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 text-stone-400 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-[#E52E2E] rounded">
                    <span>Keep me logged in</span>
                </label>
                <span class="text-[#E52E2E] text-[11px] font-mono">admin@burgerhouse.com</span>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-[#E52E2E] hover:bg-[#C61A1A] text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-red-500/25 border-2 border-white/30 flex items-center justify-center gap-2">
                <span>Access Management Portal</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

        <div class="text-center pt-2">
            <a href="{{ route('home') }}" class="text-xs text-stone-400 hover:text-white transition">
                &larr; Return to Public Storefront
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) window.lucide.createIcons();
        });
    </script>
</body>
</html>
