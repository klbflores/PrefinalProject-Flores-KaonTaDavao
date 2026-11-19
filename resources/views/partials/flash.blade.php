@if (session('success'))
    <div class="mb-6 rounded-xl bg-amber-100 border-2 border-amber-500 text-[#23120B] px-4 py-3 text-sm font-bold shadow-xs">
        {{ session('success') }}
    </div>
@endif