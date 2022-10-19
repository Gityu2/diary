<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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

    }
}
