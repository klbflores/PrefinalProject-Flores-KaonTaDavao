@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-2xl font-black text-[#23120B]">Davao Eateries</h1>
        <a href="{{ route('eateries.create') }}"
           class="bg-[#23120B] text-amber-400 px-4 py-2 rounded-full text-sm font-extrabold hover:bg-[#3B1E10] transition self-start">
            + Add New Eatery
        </a>
    </div>

    <form action="{{ route('eateries.index') }}" method="GET"
          class="bg-white border border-[#EAD8C0] rounded-2xl p-5 mb-6 shadow-sm grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="q" class="block text-xs font-extrabold uppercase tracking-wide text-[#5C341E] mb-1">
                Search Name or Specialty
            </label>
            <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="e.g. Tinola, Flores..."
                   class="w-full rounded-xl border-[#D6BE9C] border px-3 py-2 text-sm text-[#23120B] focus:border-amber-500 focus:outline-none">
        </div>

        <div>
            <label for="district" class="block text-xs font-extrabold uppercase tracking-wide text-[#5C341E] mb-1">
                District
            </label>
            <select name="district" id="district"
                    class="w-full rounded-xl border-[#D6BE9C] border px-3 py-2 text-sm text-[#23120B] bg-white focus:border-amber-500 focus:outline-none">
                <option value="">All Districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected(request('district') == $district->id)>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="feature" class="block text-xs font-extrabold uppercase tracking-wide text-[#5C341E] mb-1">
                Feature
            </label>
            <select name="feature" id="feature"
                    class="w-full rounded-xl border-[#D6BE9C] border px-3 py-2 text-sm text-[#23120B] bg-white focus:border-amber-500 focus:outline-none">
                <option value="">All Features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>
                        {{ $feature->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button type="submit"
                    class="bg-amber-500 text-[#23120B] px-4 py-2 rounded-xl text-sm font-extrabold hover:bg-amber-400 transition flex-1 cursor-pointer">
                Filter
            </button>
            <a href="{{ route('eateries.index') }}"
               class="bg-[#F3E5D0] text-[#5C341E] px-3.5 py-2 rounded-xl text-sm font-bold hover:bg-[#E7D3B5] transition">
                Reset
            </a>
        </div>
    </form>

    @if ($eateries->isEmpty())
        <div class="bg-white border border-[#EAD8C0] rounded-2xl p-8 text-center text-[#5C341E] font-medium">
            No eateries match your filters.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $eateries->links() }}
        </div>
    @endif
@endsection