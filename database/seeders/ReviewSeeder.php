<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $myEatery = Eatery::where('slug', 'carinderia-ni-flores')->first();
        $tita = User::where('email', 'tita.flores@kaonta.test')->first();
        $me = User::where('email', 'flores@kaonta.test')->first();

        // Required review by Tita Flores
        $myEatery->reviews()->create([
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Flores.',
        ]);

        // At least 2 more reviews on Carinderia ni Flores
        $myEatery->reviews()->create([
            'user_id' => $me->id,
            'rating' => 5,
            'body' => 'Best tinola in Poblacion, super sulit for students!',
        ]);

        Review::factory(2)->create([
            'eatery_id' => $myEatery->id,
        ]);

        // Open factory eateries get 0-6 reviews; closed eateries get none
        $openFactoryEateries = Eatery::where('slug', '!=', 'carinderia-ni-flores')
            ->where('is_open', true)
            ->get();

        foreach ($openFactoryEateries as $eatery) {
            $count = rand(0, 6);
            if ($count > 0) {
                Review::factory($count)->create([
                    'eatery_id' => $eatery->id,
                ]);
            }
        }
    }
}