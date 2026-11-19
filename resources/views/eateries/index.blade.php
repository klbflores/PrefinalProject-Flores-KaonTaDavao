@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-stone-900">Davao Eateries</h1>
        <a href="{{ route('eateries.create') }}" class="bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-800 self-start">
            + Add New Eatery
        </a>
    </div>

    <form action="{{ route('eateries.index') }}" method="GET" class="bg-white border border-stone-200 rounded-xl p-4 mb-6 shadow-sm grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="q" class="block text-xs font-semibold text-stone-600 mb-1">Search Name or Specialty</label>
            <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="e.g. Tinola, Flores..."
                   class="w-full rounded-lg border-stone-300 border px-3 py-2 text-sm">
        </div>

        <div>
            <label for="district" class="block text-xs font-semibold text-stone-600 mb-1">District</label>
            <select name="district" id="district" class="w-full rounded-lg border-stone-300 border px-3 py-2 text-sm">
                <option value="">All Districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected(request('district') == $district->id)>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="feature" class="block text-xs font-semibold text-stone-600 mb-1">Feature</label>
            <select name="feature" id="feature" class="w-full rounded-lg border-stone-300 border px-3 py-2 text-sm">
                <option value="">All Features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>
                        {{ $feature->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-800 flex-1">
                Filter
            </button>
            <a href="{{ route('eateries.index') }}" class="bg-stone-200 text-stone-700 px-3 py-2 rounded-lg text-sm font-medium hover:bg-stone-300">
                Reset
            </a>
        </div>
    </form>

    @if ($eateries->isEmpty())
        <div class="bg-white border border-stone-200 rounded-xl p-8 text-center text-stone-600">
            No eateries match your filters.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>

        <div class="mt-6">
            {{ $eateries->links() }}
        </div>
    @endif
@endsection