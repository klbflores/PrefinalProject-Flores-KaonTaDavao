<header class="bg-emerald-800 text-white shadow">
    <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight">
            Kaon Ta! Davao Flores's Food Guide
        </a>

        <nav class="flex flex-wrap gap-4 text-sm font-medium">
            <a href="{{ route('home') }}" class="hover:text-amber-300">Home</a>
            <a href="{{ route('eateries.index') }}" class="hover:text-amber-300">Eateries</a>
            <a href="{{ route('districts.index') }}" class="hover:text-amber-300">Districts</a>
            <a href="{{ route('eateries.create') }}" class="bg-amber-500 text-stone-900 px-3 py-1 rounded font-semibold hover:bg-amber-400">
                + Add Eatery
            </a>
        </nav>
    </div>
</header>