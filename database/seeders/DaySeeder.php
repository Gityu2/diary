<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Day;


class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()); 
        
        $faker = Faker::create('en_US');

        foreach($days as $day){
            Day::create([
                'date' => $day,
                'fact' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'discovery' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'lesson' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'next_action' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'image' => $faker->randomElement(['', 'dog1.jpeg', 'dog2.jpeg', 'dog3.jpeg', 'dog4.jpeg']),
                'user_id' => 2
            ]);
        }

        $lat_year_days = CarbonPeriod::create(Carbon::create(now())->subYear()->startOfYear(), Carbon::create(now())->subYear()->endOfYear()); 
        
        foreach($lat_year_days as $day){
            Day::create([
                'date' => $day,
                'fact' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'discovery' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'lesson' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'next_action' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'user_id' => 2
            ]);
        }

    }
}
