<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaon Ta! Davao Flores's Food Guide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        nav[role="navigation"] svg {
            width: 1.25rem;
            height: 1.25rem;
            display: inline-block;
        }

        nav[role="navigation"] p {
            color: #5c341e !important;
        }
        nav[role="navigation"] p span {
            color: #23120b !important;
            background: transparent !important;
            border: none !important;
            margin: 0 !important;
        }

        nav[role="navigation"] a,
        nav[role="navigation"] span[aria-current="page"] > span,
        nav[role="navigation"] span[aria-disabled="true"] > span,
        nav[role="navigation"] span[aria-disabled="true"] {
            border-radius: 0.65rem !important;
            margin: 0 0.15rem !important;
            font-size: 0.875rem !important;
            font-weight: 700 !important;
            transition: all 0.15s ease-in-out !important;
        }

        /* Inactive clickable page numbers */
        nav[role="navigation"] a {
            background-color: #ffffff !important;
            border: 1px solid #e7d5be !important;
            color: #23120b !important;
        }

        nav[role="navigation"] a:hover {
            background-color: #fef3c7 !important;
            border-color: #f59e0b !important;
            color: #78350f !important;
        }

        nav[role="navigation"] span[aria-current="page"] > span {
            background-color: #f59e0b !important;
            color: #23120b !important;
            border: 1px solid #d97706 !important;
        }

        nav[role="navigation"] span[aria-disabled="true"] > span,
        nav[role="navigation"] span[aria-disabled="true"] {
            background-color: #faf0e1 !important;
            border: 1px solid #ead8c0 !important;
            color: #b59a7e !important;
            cursor: not-allowed !important;
        }
    </style>
</head>
<body class="bg-[#FDF5E6] text-[#23120B] antialiased min-h-screen flex flex-col">
    @include('partials.nav')

    <main class="max-w-6xl w-full mx-auto px-4 py-8 flex-1">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="bg-[#23120B] text-amber-100/80 border-t border-amber-900/40 py-5 text-center text-sm">
        Kaon Ta! Davao Flores's Food Guide &copy; 2026
    </footer>
</body>
</html>