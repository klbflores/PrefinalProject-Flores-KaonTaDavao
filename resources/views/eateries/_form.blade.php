@if ($errors->any())
    <div class="mb-6 rounded-xl bg-red-50 border border-red-300 text-red-900 p-4 text-sm">
        <p class="font-bold mb-1">Please fix the following errors:</p>
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $selectedFeatures = old('features', isset($eatery) ? $eatery->features->pluck('id')->all() : []);
    $isOpen = old('is_open', isset($eatery) ? $eatery->is_open : true);
@endphp

<div class="space-y-5">
    <div>
        <label for="name" class="block text-sm font-bold text-[#23120B] mb-1">Eatery Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $eatery->name ?? '') }}"
               class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] focus:border-amber-500 focus:outline-none">
        @error('name')
            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="district_id" class="block text-sm font-bold text-[#23120B] mb-1">District</label>
            <select name="district_id" id="district_id"
                    class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] bg-white focus:border-amber-500 focus:outline-none">
                <option value="">Select District</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id ?? '') == $district->id)>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
            @error('district_id')
                <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price_range" class="block text-sm font-bold text-[#23120B] mb-1">Price Range</label>
            <select name="price_range" id="price_range"
                    class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] bg-white focus:border-amber-500 focus:outline-none">
                <option value="">Select Price Range</option>
                <option value="budget" @selected(old('price_range', $eatery->price_range ?? '') === 'budget')>Budget (₱)</option>
                <option value="mid" @selected(old('price_range', $eatery->price_range ?? '') === 'mid')>Mid-Range (₱₱)</option>
                <option value="splurge" @selected(old('price_range', $eatery->price_range ?? '') === 'splurge')>Splurge (₱₱₱)</option>
            </select>
            @error('price_range')
                <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="address" class="block text-sm font-bold text-[#23120B] mb-1">Address</label>
        <input type="text" name="address" id="address" value="{{ old('address', $eatery->address ?? '') }}"
               class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] focus:border-amber-500 focus:outline-none">
        @error('address')
            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="specialty" class="block text-sm font-bold text-[#23120B] mb-1">Specialty (Optional)</label>
        <input type="text" name="specialty" id="specialty" value="{{ old('specialty', $eatery->specialty ?? '') }}"
               class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] focus:border-amber-500 focus:outline-none">
        @error('specialty')
            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="permit_no" class="block text-sm font-bold text-[#23120B] mb-1">Business Permit Number</label>
            <input type="text" name="permit_no" id="permit_no"
                   value="{{ old('permit_no', $eatery->permit->permit_no ?? '') }}"
                   placeholder="DVO-2026-0415"
                   class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] focus:border-amber-500 focus:outline-none">
            @error('permit_no')
                <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="expires_on" class="block text-sm font-bold text-[#23120B] mb-1">Permit Expiry Date</label>
            <input type="date" name="expires_on" id="expires_on"
                   value="{{ old('expires_on', isset($eatery->permit->expires_on) ? $eatery->permit->expires_on->format('Y-m-d') : '') }}"
                   class="w-full rounded-xl border border-[#D6BE9C] px-3 py-2 text-sm text-[#23120B] focus:border-amber-500 focus:outline-none">
            @error('expires_on')
                <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <span class="block text-sm font-bold text-[#23120B] mb-2">Features</span>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 bg-[#FDF5E6] p-3.5 rounded-xl border border-[#EAD8C0]">
            @foreach ($features as $feature)
                <label class="inline-flex items-center gap-2 text-sm font-medium text-[#23120B]">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                           @checked(in_array($feature->id, $selectedFeatures))
                           class="rounded border-[#D6BE9C] text-amber-600 focus:ring-amber-500">
                    <span>{{ $feature->name }}</span>
                </label>
            @endforeach
        </div>
        @error('features')
            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
        @error('features.*')
            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="inline-flex items-center gap-2 text-sm font-bold text-[#23120B]">
            <input type="checkbox" name="is_open" value="1" @checked((bool) $isOpen)
                   class="rounded border-[#D6BE9C] text-amber-600 focus:ring-amber-500">
            <span>Currently Open for Business</span>
        </label>
        @error('is_open')
            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>
</div>