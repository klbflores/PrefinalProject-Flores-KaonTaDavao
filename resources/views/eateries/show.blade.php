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

    <div class="bg-white border border-stone-200 rounded-xl p-6 shadow-sm mb-6">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-stone-900">{{ $eatery->name }}</h1>
                    @if ($eatery->is_open)
                        <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Open</span>
                    @else
                        <span class="bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Closed</span>
                    @endif
                </div>

                <p class="text-sm text-stone-600 mt-1">
                    <a href="{{ route('districts.show', $eatery->district) }}" class="text-emerald-700 font-semibold hover:underline">
                        {{ $eatery->district->name }}
                    </a>
                    &bull; {{ $eatery->address }} &bull; {{ $priceLabel }}
                </p>

                @if ($eatery->specialty)
                    <p class="text-sm text-stone-700 mt-2">
                        <span class="font-semibold">Specialty:</span> {{ $eatery->specialty }}
                    </p>
                @endif

                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($eatery->features as $feature)
                        <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                           class="text-xs bg-amber-100 text-amber-900 px-2.5 py-1 rounded-full hover:bg-amber-200">
                            {{ $feature->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('eateries.edit', $eatery) }}"
                   class="bg-amber-500 text-stone-900 px-3.5 py-2 rounded-lg text-sm font-semibold hover:bg-amber-400">
                    Edit
                </a>

                <form action="{{ route('eateries.destroy', $eatery) }}" method="POST"
                      onsubmit="return confirm('Delete this eatery and all its records?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-3.5 py-2 rounded-lg text-sm font-semibold hover:bg-red-700">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        @if ($eatery->permit)
            <div class="mt-5 pt-4 border-t border-stone-100 flex flex-wrap items-center gap-4 text-sm">
                <div>
                    <span class="font-semibold text-stone-700">Business Permit:</span>
                    <span class="font-mono">{{ $eatery->permit->permit_no }}</span>
                </div>
                <div>
                    <span class="font-semibold text-stone-700">Expires on:</span>
                    <span>{{ $eatery->permit->expires_on->format('F d, Y') }}</span>
                </div>
                @if ($eatery->permit->expires_on->lt(today()))
                    <span class="text-red-600 font-bold">Permit expired</span>
                @endif
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white border border-stone-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-lg font-bold text-stone-900 mb-3">Menu & Dishes</h2>

                @if ($eatery->dishes->isEmpty())
                    <p class="text-sm text-stone-500">No dishes listed yet.</p>
                @else
                    <ul class="divide-y divide-stone-100">
                        @foreach ($eatery->dishes as $dish)
                            <li class="py-2.5 flex items-center justify-between gap-2 text-sm">
                                <div>
                                    <span class="font-medium text-stone-800">{{ $dish->name }}</span>
                                    @if ($dish->is_bestseller)
                                        <span class="ml-1.5 text-xs bg-amber-100 text-amber-900 font-semibold px-2 py-0.5 rounded">
                                            Bestseller
                                        </span>
                                    @endif
                                </div>
                                <span class="font-semibold text-stone-700">₱{{ number_format($dish->price, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-stone-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-lg font-bold text-stone-900 mb-3">Write a Review</h2>

                @if ($eatery->is_open)
                    @if ($errors->any())
                        <div class="mb-4 rounded-lg bg-red-50 border border-red-300 text-red-800 p-3 text-sm">
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
                                <label for="user_id" class="block text-sm font-semibold text-stone-700 mb-1">Reviewer</label>
                                <select name="user_id" id="user_id" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                                    <option value="">Select Reviewer</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="rating" class="block text-sm font-semibold text-stone-700 mb-1">Rating (1-5)</label>
                                <select name="rating" id="rating" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                                    <option value="">Select Rating</option>
                                    @for ($r = 5; $r >= 1; $r--)
                                        <option value="{{ $r }}" @selected(old('rating') == $r)>
                                            {{ $r }} {{ Str::plural('Star', $r) }}
                                        </option>
                                    @endfor
                                </select>
                                @error('rating')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-semibold text-stone-700 mb-1">Your Review</label>
                            <textarea name="body" id="body" rows="3"
                                      class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-800">
                            Post Review
                        </button>
                    </form>
                @else
                    <p class="text-sm text-red-700 font-medium">This eatery is closed. Reviews are paused.</p>
                @endif
            </div>

            <div class="bg-white border border-stone-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-lg font-bold text-stone-900 mb-4">
                    Resident Reviews ({{ $eatery->reviews->count() }})
                </h2>

                @if ($eatery->reviews->isEmpty())
                    <p class="text-sm text-stone-500">No reviews yet. Be the first to review!</p>
                @else
                    <div class="space-y-4">
                        @foreach ($eatery->reviews as $review)
                            <div class="border-b border-stone-100 pb-4 last:border-none last:pb-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <a href="{{ route('reviewers.show', $review->user) }}"
                                           class="font-semibold text-sm text-emerald-700 hover:underline">
                                            {{ $review->user->name }}
                                        </a>
                                        <div class="flex items-center gap-2 text-xs text-stone-500 mt-0.5">
                                            <x-rating :rating="$review->rating" />
                                            <span>&bull;</span>
                                            <span>{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>

                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                                <p class="mt-2 text-sm text-stone-700">{{ $review->body }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection