@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-black text-[#23120B]">{{ $district->name }}</h1>
        <p class="text-sm font-semibold text-[#5C341E] mt-1">
            {{ $district->reviews_count }} {{ Str::plural('review', $district->reviews_count) }} in {{ $district->name }}
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection