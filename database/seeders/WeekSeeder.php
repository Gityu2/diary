<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Week;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weeks = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear())->week();
        
        $faker = Faker::create('en_US');

        $num = 1;

        foreach($weeks as $week){
            Week::create([
                'date' => $week,
                'week' => $num ++,
                'fact' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'discovery' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'lesson' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'next_action' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'user_id' => 2
            ]);
        }

        $last_year_weeks = CarbonPeriod::create(Carbon::create(now())->subYear()->startOfYear(), Carbon::create(now())->subYear()->endOfYear())->week();
        $num = 1;

        foreach($last_year_weeks as $week){
            Week::create([
                'date' => $week,
                'week' => $num ++,
                'fact' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'discovery' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'lesson' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'next_action' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'user_id' => 2
            ]);
        }
    }
}
