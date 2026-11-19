@if (session('success'))
    <div class="mb-6 rounded-lg bg-emerald-100 border border-emerald-300 text-emerald-900 px-4 py-3 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif