<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaon Ta! Davao Flores's Food Guide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-50/40 text-stone-800 min-h-screen flex flex-col">
    @include('partials.nav')

    <main class="max-w-6xl w-full mx-auto px-4 py-8 flex-1">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="bg-white border-t border-stone-200 py-4 text-center text-sm text-stone-500">
        Kaon Ta! Davao Flores's Food Guide &copy; 2026
    </footer>
</body>
</html>