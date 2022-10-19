<?php

namespace Database\Seeders;

use App\Models\DayLike;
use Illuminate\Database\Seeder;

class DayLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100; $i++){
            DayLike::create([
                'user_id' => 2,
                'day_id' => rand(1, 365)
            ]);
        }

    }
}
