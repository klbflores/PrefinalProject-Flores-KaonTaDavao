@props(['eatery'])

@php
    $priceLabel = match ($eatery->price_range) {
        'budget' => '₱',
        'mid' => '₱₱',
        'splurge' => '₱₱₱',
        default => '₱',
    };
@endphp

<article class="bg-white rounded-2xl border border-[#EAD8C0] border-t-4 border-t-[#5C341E] p-5 shadow-sm hover:shadow-md hover:border-amber-500 transition flex flex-col justify-between">
    <div>
        <div class="flex items-start justify-between gap-2">
            <h3 class="text-lg font-black text-[#23120B] leading-snug">
                <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-amber-700 transition">
                    {{ $eatery->name }}
                </a>
            </h3>

            @unless ($eatery->is_open)
                <span class="shrink-0 bg-red-100 text-red-800 border border-red-300 text-xs font-bold px-2.5 py-0.5 rounded-full">
                    Closed
                </span>
            @endunless
        </div>

        <div class="mt-1.5 flex items-center gap-2 text-sm text-[#5C341E]">
            <a href="{{ route('districts.show', $eatery->district) }}" class="text-amber-800 hover:text-amber-600 hover:underline font-bold">
                {{ $eatery->district->name }}
            </a>
            <span>&bull;</span>
            <span class="font-extrabold text-[#23120B]">{{ $priceLabel }}</span>
        </div>

        @if ($eatery->specialty)
            <p class="mt-2.5 text-sm text-[#5C341E]">
                <span class="font-bold text-[#23120B]">Specialty:</span> {{ $eatery->specialty }}
            </p>
        @endif

        <div class="mt-3.5 flex flex-wrap gap-1.5">
            @foreach ($eatery->features as $feature)
                <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                   class="text-xs font-bold bg-amber-400/90 text-[#23120B] px-3 py-1 rounded-full hover:bg-amber-500 transition">
                    {{ $feature->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="mt-5 pt-3 border-t border-[#F3E5D0] text-sm">
        @if ($eatery->reviews_count > 0)
            <div class="flex items-center gap-1.5">
                <x-rating :rating="$eatery->reviews_avg_rating" />
                <span class="font-extrabold text-[#23120B]">
                    {{ number_format($eatery->reviews_avg_rating, 1) }}
                </span>
                <span class="text-[#5C341E]">
                    ({{ $eatery->reviews_count }} {{ Str::plural('review', $eatery->reviews_count) }})
                </span>
            </div>
        @else
            <span class="text-[#8C6D53] italic">No reviews yet</span>
        @endif
    </div>
</article>