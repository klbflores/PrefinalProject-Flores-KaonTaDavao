@extends('layouts.app')

@section('content')
    @php
        $priceLabel = match ($eatery->price_range) {
            'budget' => '₱ (Budget)',
            'mid' => '₱₱ (Mid-Range)',
            'splurge' => '₱₱₱ (Splurge)',
            default => '₱',
        };
    @endphp

    <div class="bg-white border border-[#EAD8C0] border-t-4 border-t-[#23120B] rounded-2xl p-6 shadow-sm mb-6">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-black text-[#23120B]">{{ $eatery->name }}</h1>
                    @if ($eatery->is_open)
                        <span class="bg-amber-400 text-[#23120B] text-xs font-extrabold px-3 py-0.5 rounded-full">Open</span>
                    @else
                        <span class="bg-red-100 text-red-800 border border-red-300 text-xs font-extrabold px-3 py-0.5 rounded-full">Closed</span>
                    @endif
                </div>

                <p class="text-sm text-[#5C341E] mt-1.5">
                    <a href="{{ route('districts.show', $eatery->district) }}" class="text-amber-800 font-extrabold hover:underline">
                        {{ $eatery->district->name }}
                    </a>
                    &bull; {{ $eatery->address }} &bull; <span class="font-bold text-[#23120B]">{{ $priceLabel }}</span>
                </p>

                @if ($eatery->specialty)
                    <p class="text-sm text-[#5C341E] mt-2">
                        <span class="font-bold text-[#23120B]">Specialty:</span> {{ $eatery->specialty }}
                    </p>
                @endif

                <div class="mt-3.5 flex flex-wrap gap-2">
                    @foreach ($eatery->features as $feature)
                        <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                           class="text-xs font-bold bg-amber-400/90 text-[#23120B] px-3 py-1 rounded-full hover:bg-amber-500 transition">
                            {{ $feature->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('eateries.edit', $eatery) }}"
                   class="bg-amber-500 text-[#23120B] px-4 py-2 rounded-xl text-sm font-extrabold hover:bg-amber-400 transition">
                    Edit
                </a>

                <form action="{{ route('eateries.destroy', $eatery) }}" method="POST"
                      onsubmit="return confirm('Delete this eatery and all its records?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-[#23120B] text-red-300 px-4 py-2 rounded-xl text-sm font-extrabold hover:bg-red-700 hover:text-white transition cursor-pointer">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        @if ($eatery->permit)
            <div class="mt-5 pt-4 border-t border-[#F3E5D0] flex flex-wrap items-center gap-4 text-sm bg-[#FDF5E6] px-4 py-3 rounded-xl">
                <div>
                    <span class="font-bold text-[#23120B]">Business Permit:</span>
                    <span class="font-mono font-semibold text-[#5C341E]">{{ $eatery->permit->permit_no }}</span>
                </div>
                <div>
                    <span class="font-bold text-[#23120B]">Expires on:</span>
                    <span class="text-[#5C341E]">{{ $eatery->permit->expires_on->format('F d, Y') }}</span>
                </div>
                @if ($eatery->permit->expires_on->lt(today()))
                    <span class="text-red-600 font-extrabold">Permit expired</span>
                @endif
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white border border-[#EAD8C0] rounded-2xl p-5 shadow-sm">
                <h2 class="text-lg font-black text-[#23120B] mb-3">Menu & Dishes</h2>

                @if ($eatery->dishes->isEmpty())
                    <p class="text-sm text-[#8C6D53]">No dishes listed yet.</p>
                @else
                    <ul class="divide-y divide-[#F3E5D0]">
                        @foreach ($eatery->dishes as $dish)
                            <li class="py-2.5 flex items-center justify-between gap-2 text-sm">
                                <div>
                                    <span class="font-bold text-[#23120B]">{{ $dish->name }}</span>
                                    @if ($dish->is_bestseller)
                                        <span class="ml-1.5 text-xs bg-[#23120B] text-amber-400 font-bold px-2 py-0.5 rounded-full">
                                            Bestseller
                                        </span>
                                    @endif
                                </div>
                                <span class="font-extrabold text-[#5C341E]">₱{{ number_format($dish->price, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-[#EAD8C0] rounded-2xl p-5 shadow-sm">
                <h2 class="text-lg font-black text-[#23120B] mb-3">Write a Review</h2>

                @if ($eatery->is_open)
                    @if ($errors->any())
                        <div class="mb-4 rounded-xl bg-red-50 border border-red-300 text-red-900 p-3 text-sm">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('eateries.reviews.store', $eatery) }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="user_id" class="block text-sm font-bold text-[#23120B] mb-1">Reviewer</label>
                                <select name="user_id" id="user_id"
                                        class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] bg-white focus:border-amber-500 focus:outline-none">
                                    <option value="">Select Reviewer</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="rating" class="block text-sm font-bold text-[#23120B] mb-1">Rating (1-5)</label>
                                <select name="rating" id="rating"
                                        class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] bg-white focus:border-amber-500 focus:outline-none">
                                    <option value="">Select Rating</option>
                                    @for ($r = 5; $r >= 1; $r--)
                                        <option value="{{ $r }}" @selected(old('rating') == $r)>
                                            {{ $r }} {{ Str::plural('Star', $r) }}
                                        </option>
                                    @endfor
                                </select>
                                @error('rating')
                                    <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-bold text-[#23120B] mb-1">Your Review</label>
                            <textarea name="body" id="body" rows="3"
                                      class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] focus:border-amber-500 focus:outline-none">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="bg-amber-500 text-[#23120B] px-5 py-2 rounded-xl text-sm font-extrabold hover:bg-amber-400 transition cursor-pointer">
                            Post Review
                        </button>
                    </form>
                @else
                    <p class="text-sm text-red-700 font-bold">This eatery is closed. Reviews are paused.</p>
                @endif
            </div>

            <div class="bg-white border border-[#EAD8C0] rounded-2xl p-5 shadow-sm">
                <h2 class="text-lg font-black text-[#23120B] mb-4">
                    Resident Reviews ({{ $eatery->reviews->count() }})
                </h2>

                @if ($eatery->reviews->isEmpty())
                    <p class="text-sm text-[#8C6D53]">No reviews yet. Be the first to review!</p>
                @else
                    <div class="space-y-4">
                        @foreach ($eatery->reviews as $review)
                            <div class="border-b border-[#F3E5D0] pb-4 last:border-none last:pb-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <a href="{{ route('reviewers.show', $review->user) }}"
                                           class="font-extrabold text-sm text-amber-800 hover:underline">
                                            {{ $review->user->name }}
                                        </a>
                                        <div class="flex items-center gap-2 text-xs text-[#5C341E] mt-0.5">
                                            <x-rating :rating="$review->rating" />
                                            <span>&bull;</span>
                                            <span>{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>

                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-red-600 hover:underline cursor-pointer">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                                <p class="mt-2 text-sm text-[#23120B]">{{ $review->body }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection