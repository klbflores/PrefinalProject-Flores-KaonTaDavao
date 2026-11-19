<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        $poblacion = District::where('name', 'Poblacion')->first();

        // 1. Hand-made eatery
        $myEatery = Eatery::create([
            'district_id' => $poblacion->id,
            'name' => 'Carinderia ni Flores',
            'slug' => Str::slug('Carinderia ni Flores'),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        $myFeatureIds = Feature::whereIn('name', ['Suki ni Flores', 'Budget Meal'])->pluck('id');
        $myEatery->features()->sync($myFeatureIds);

        $myEatery->permit()->create([
            'permit_no' => 'DVO-2026-0204',
            'expires_on' => '2027-02-04',
        ]);

        $myEatery->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120.00, 'is_bestseller' => false],
            ['name' => 'Durian Shake', 'price' => 75.00, 'is_bestseller' => false],
        ]);

        // 2. 11 open factory eateries
        $openEateries = Eatery::factory(11)->create();

        // 3. 3 closed factory eateries
        $closedEateries = Eatery::factory(3)->closed()->create();

        $allFactoryEateries = $openEateries->merge($closedEateries);
        $allFeatureIds = Feature::pluck('id');

        foreach ($allFactoryEateries as $index => $eatery) {
            // Make sure at least the first factory eatery has an expired permit
            if ($index === 0) {
                Permit::factory()->create([
                    'eatery_id' => $eatery->id,
                    'expires_on' => now()->subDays(15)->format('Y-m-d'),
                ]);
            } else {
                Permit::factory()->create([
                    'eatery_id' => $eatery->id,
                ]);
            }

            Dish::factory(rand(2, 5))->create([
                'eatery_id' => $eatery->id,
            ]);

            $randomFeatures = $allFeatureIds->random(rand(1, 3));
            $eatery->features()->attach($randomFeatures);
        }
    }
}