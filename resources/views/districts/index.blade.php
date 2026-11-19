@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-black text-[#23120B] mb-6">Davao City Districts</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}"
               class="bg-white border border-[#EAD8C0] border-t-4 border-t-amber-500 rounded-2xl p-5 shadow-sm hover:border-amber-500 hover:shadow-md transition block">
                <h2 class="text-lg font-black text-[#23120B]">{{ $district->name }}</h2>
                <p class="text-sm font-semibold text-[#5C341E] mt-1">
                    {{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}
                </p>
            </a>
        @endforeach
    </div>
@endsection