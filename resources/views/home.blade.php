@extends('layouts.app')

@section('content')
    <section class="mb-8">
        <h1 class="text-2xl font-bold text-stone-900">Maayong Pag-abot sa Davao!</h1>
        <p class="text-stone-600 mt-1">Discover local carinderias, budget meals, and neighborhood favorites across Davao City.</p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
            <div class="bg-white border border-stone-200 rounded-xl p-5 text-center shadow-sm">
                <p class="text-3xl font-extrabold text-emerald-700">{{ $eateryCount }}</p>
                <p class="text-sm text-stone-600 mt-1">Eateries Listed</p>
            </div>
            <div class="bg-white border border-stone-200 rounded-xl p-5 text-center shadow-sm">
                <p class="text-3xl font-extrabold text-emerald-700">{{ $districtCount }}</p>
                <p class="text-sm text-stone-600 mt-1">Districts Covered</p>
            </div>
            <div class="bg-white border border-stone-200 rounded-xl p-5 text-center shadow-sm">
                <p class="text-3xl font-extrabold text-emerald-700">{{ $reviewCount }}</p>
                <p class="text-sm text-stone-600 mt-1">Resident Reviews</p>
            </div>
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-stone-900">Top Rated Eateries</h2>
            <a href="{{ route('eateries.index') }}" class="text-sm font-medium text-emerald-700 hover:underline">
                Browse all eateries &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($topRatedEateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    </section>
@endsection