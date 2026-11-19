<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EateryController extends Controller
{
    public function index(Request $request): View
    {
        $eateries = Eatery::with(['district', 'features'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->q;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('specialty', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('district'), function ($query) use ($request) {
                $query->where('district_id', $request->district);
            })
            ->when($request->filled('feature'), function ($query) use ($request) {
                $query->whereHas('features', function ($q) use ($request) {
                    $q->where('name', $request->feature);
                });
            })
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.index', compact('eateries', 'districts', 'features'));
    }

    public function create(): View
    {
        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.create', compact('districts', 'features'));
    }

    public function store(StoreEateryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $eatery = Eatery::create([
            'district_id' => $validated['district_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'address' => $validated['address'],
            'price_range' => $validated['price_range'],
            'specialty' => $validated['specialty'] ?? null,
            'is_open' => $validated['is_open'],
        ]);

        $eatery->permit()->create([
            'permit_no' => $validated['permit_no'],
            'expires_on' => $validated['expires_on'],
        ]);

        $eatery->features()->sync($validated['features']);

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('success', 'Eatery added.');
    }

    public function show(Eatery $eatery): View
    {
        $eatery->load([
            'district',
            'permit',
            'features',
            'dishes',
            'reviews' => fn ($query) => $query->latest()->with('user'),
        ]);

        $users = User::orderBy('name')->get();

        return view('eateries.show', compact('eatery', 'users'));
    }

    public function edit(Eatery $eatery): View
    {
        $eatery->load(['permit', 'features']);
        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.edit', compact('eatery', 'districts', 'features'));
    }

    public function update(UpdateEateryRequest $request, Eatery $eatery): RedirectResponse
    {
        $validated = $request->validated();

        $eatery->update([
            'district_id' => $validated['district_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'address' => $validated['address'],
            'price_range' => $validated['price_range'],
            'specialty' => $validated['specialty'] ?? null,
            'is_open' => $validated['is_open'],
        ]);

        $eatery->permit()->updateOrCreate(
            ['eatery_id' => $eatery->id],
            [
                'permit_no' => $validated['permit_no'],
                'expires_on' => $validated['expires_on'],
            ]
        );

        $eatery->features()->sync($validated['features']);

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('success', 'Eatery updated.');
    }

    public function destroy(Eatery $eatery): RedirectResponse
    {
        $eatery->permit()->delete();
        $eatery->dishes()->delete();
        $eatery->reviews()->delete();
        $eatery->features()->detach();
        $eatery->delete();

        return redirect()
            ->route('eateries.index')
            ->with('success', 'Eatery deleted.');
    }
}