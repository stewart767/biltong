<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Login | INAS Premium Beef Biltong</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-black text-brand-cream font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md p-8 sm:p-10 rounded-3xl bg-brand-charcoal border border-brand-border space-y-8 shadow-2xl">
        <div class="text-center space-y-3">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-brand-card flex items-center justify-center border border-brand-red/50 shadow-inner">
                <span class="font-editorial text-2xl font-bold text-brand-red">I</span>
            </div>
            <div>
                <span class="font-editorial text-2xl font-bold tracking-wider text-brand-cream uppercase block">INAS Operations</span>
                <p class="text-xs text-brand-muted uppercase tracking-widest">Buguruni Malapa • Staff Authentication</p>
            </div>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-950/80 border border-red-500/60 text-red-300 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Staff Email</label>
                <input type="email" name="email" value="{{ old('email', 'admin@inas.co.tz') }}" required autofocus
                       class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Password</label>
                <input type="password" name="password" value="password" required
                       class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 text-brand-muted">
                    <input type="checkbox" name="remember" class="text-brand-red focus:ring-brand-red rounded">
                    <span>Keep me logged in</span>
                </label>
                <span class="text-brand-red text-[11px]">Default: admin@inas.co.tz / password</span>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold font-bold text-sm hover:shadow-xl transition flex items-center justify-center gap-2">
                <span>Access Management Portal</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>

        <div class="text-center pt-2">
            <a href="{{ route('home') }}" class="text-xs text-brand-muted hover:text-brand-cream transition">
                &larr; Return to Public Storefront
            </a>
        </div>
    </div>

</body>
</html>
