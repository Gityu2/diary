<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Day;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            DaySeeder::class,
            WeekSeeder::class,
            MonthSeeder::class,
            YearSeeder::class,
            DayLikeSeeder::class,
        ]);

        // Day::factory(30)->create();

    }
}
