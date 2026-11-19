<header class="bg-[#23120B] text-[#FDF5E6] shadow-md">
    <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <a href="{{ route('home') }}" class="text-xl font-black tracking-tight text-amber-400 hover:text-amber-300 transition">
            Kaon Ta! Davao Flores's Food Guide
        </a>

        <nav class="flex flex-wrap items-center gap-2 sm:gap-3 text-sm font-bold">
            <a href="{{ route('home') }}" class="px-3 py-1.5 rounded-full text-amber-100 hover:bg-amber-900/50 hover:text-white transition">
                Home
            </a>
            <a href="{{ route('eateries.index') }}" class="px-3 py-1.5 rounded-full text-amber-100 hover:bg-amber-900/50 hover:text-white transition">
                Eateries
            </a>
            <a href="{{ route('districts.index') }}" class="px-3 py-1.5 rounded-full text-amber-100 hover:bg-amber-900/50 hover:text-white transition">
                Districts
            </a>
            <a href="{{ route('eateries.create') }}"
               class="bg-amber-500 text-[#23120B] px-4 py-1.5 rounded-full font-extrabold hover:bg-amber-400 transition shadow-xs">
                + Add Eatery
            </a>
        </nav>
    </div>
</header>