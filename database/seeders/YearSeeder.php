<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use App\Models\Year;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create('en_US');

            Year::create([
                'date' => Carbon::create(now())->startOfYear(),
                'fact' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'discovery' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'lesson' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'next_action' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'user_id' => 2
            ]);

            Year::create([
                'date' => Carbon::create(now())->subYear()->startOfYear(),
                'fact' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'discovery' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'lesson' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'next_action' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'user_id' => 2
            ]);
    }
}
