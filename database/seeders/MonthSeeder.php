<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Month;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear())->month();
        
        $faker = Faker::create('en_US');

        foreach($months as $month){
            Month::create([
                'date' => $month,
                'fact' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'discovery' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'lesson' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'next_action' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'user_id' => 2
            ]);
        }
    }
}
