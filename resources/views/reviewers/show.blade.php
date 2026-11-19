@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-black text-[#23120B]">{{ $user->name }}</h1>
        <p class="text-sm font-semibold text-[#5C341E] mt-1">
            {{ $user->reviews->count() }} {{ Str::plural('review', $user->reviews->count()) }} written
        </p>
    </div>

    <div class="space-y-4">
        @foreach ($user->reviews as $review)
            <div class="bg-white border border-[#EAD8C0] border-l-4 border-l-amber-500 rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between gap-2">
                    <a href="{{ route('eateries.show', $review->eatery) }}"
                       class="font-black text-amber-800 hover:underline">
                        {{ $review->eatery->name }}
                    </a>
                    <x-rating :rating="$review->rating" />
                </div>
                <p class="mt-2 text-sm text-[#23120B]">{{ $review->body }}</p>
            </div>
        @endforeach
    </div>
@endsection