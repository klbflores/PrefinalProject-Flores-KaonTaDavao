@extends('layouts.app')

@section('content')
    <section class="mb-10">
        <div class="bg-[#23120B] text-[#FDF5E6] rounded-3xl p-7 sm:p-10 shadow-md">
            <span class="inline-block bg-amber-500 text-[#23120B] text-xs font-black uppercase tracking-wider px-3 py-1 rounded-full mb-3">
                Davao City Food Guide
            </span>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-white">
                Maayong Pag-abot sa Davao!
            </h1>
            <p class="text-amber-100/85 mt-2 max-w-2xl text-sm sm:text-base">
                Discover local carinderias, budget meals, and neighborhood favorites across Davao City.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-7">
                <div class="bg-[#5C341E] border border-amber-800/60 rounded-2xl p-5 text-center">
                    <p class="text-3xl font-black text-amber-400">{{ $eateryCount }}</p>
                    <p class="text-xs uppercase tracking-wider font-bold text-amber-100 mt-1">Eateries Listed</p>
                </div>
                <div class="bg-amber-500 text-[#23120B] rounded-2xl p-5 text-center">
                    <p class="text-3xl font-black">{{ $districtCount }}</p>
                    <p class="text-xs uppercase tracking-wider font-extrabold mt-1">Districts Covered</p>
                </div>
                <div class="bg-[#3B1E10] border border-amber-800/60 rounded-2xl p-5 text-center">
                    <p class="text-3xl font-black text-amber-400">{{ $reviewCount }}</p>
                    <p class="text-xs uppercase tracking-wider font-bold text-amber-100 mt-1">Resident Reviews</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-2xl font-black text-[#23120B]">Top Rated Eateries</h2>
            <a href="{{ route('eateries.index') }}" class="text-sm font-extrabold text-amber-800 hover:text-amber-600 hover:underline">
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