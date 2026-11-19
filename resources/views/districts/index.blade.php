@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-stone-900 mb-6">Davao City Districts</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}"
               class="bg-white border border-stone-200 rounded-xl p-5 shadow-sm hover:border-emerald-500 transition block">
                <h2 class="text-lg font-bold text-stone-900">{{ $district->name }}</h2>
                <p class="text-sm text-stone-600 mt-1">
                    {{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}
                </p>
            </a>
        @endforeach
    </div>
@endsection