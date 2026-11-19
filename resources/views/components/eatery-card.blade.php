@props(['eatery'])

@php
    $priceLabel = match ($eatery->price_range) {
        'budget' => '₱',
        'mid' => '₱₱',
        'splurge' => '₱₱₱',
        default => '₱',
    };
@endphp

<article class="bg-white rounded-xl border border-stone-200 p-5 shadow-sm flex flex-col justify-between">
    <div>
        <div class="flex items-start justify-between gap-2">
            <h3 class="text-lg font-bold text-stone-900">
                <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-emerald-700">
                    {{ $eatery->name }}
                </a>
            </h3>

            @unless ($eatery->is_open)
                <span class="shrink-0 bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    Closed
                </span>
            @endunless
        </div>

        <div class="mt-1 flex items-center gap-2 text-sm text-stone-600">
            <a href="{{ route('districts.show', $eatery->district) }}" class="text-emerald-700 hover:underline font-medium">
                {{ $eatery->district->name }}
            </a>
            <span>&bull;</span>
            <span class="font-semibold text-stone-700">{{ $priceLabel }}</span>
        </div>

        @if ($eatery->specialty)
            <p class="mt-2 text-sm text-stone-600">
                <span class="font-medium text-stone-700">Specialty:</span> {{ $eatery->specialty }}
            </p>
        @endif

        <div class="mt-3 flex flex-wrap gap-1.5">
            @foreach ($eatery->features as $feature)
                <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                   class="text-xs bg-amber-100 text-amber-900 px-2.5 py-1 rounded-full hover:bg-amber-200">
                    {{ $feature->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="mt-4 pt-3 border-t border-stone-100 text-sm">
        @if ($eatery->reviews_count > 0)
            <div class="flex items-center gap-1.5">
                <x-rating :rating="$eatery->reviews_avg_rating" />
                <span class="font-semibold text-stone-800">
                    {{ number_format($eatery->reviews_avg_rating, 1) }}
                </span>
                <span class="text-stone-500">
                    ({{ $eatery->reviews_count }} {{ Str::plural('review', $eatery->reviews_count) }})
                </span>
            </div>
        @else
            <span class="text-stone-400 italic">No reviews yet</span>
        @endif
    </div>
</article>