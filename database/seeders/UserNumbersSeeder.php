<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserNumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_numbers')->insert([
            ['id'  => 1,
            'numbers' => '100',
            'created_at' => '2022-9-13',
            ],
            ['id'  => 2,
            'numbers' => '200',
            'created_at' => '2022-9-14',
            ],
            ['id'  => 3,
            'numbers' => '250',
            'created_at' => '2022-9-15',
            ],
            ['id'  => 4,
            'numbers' => '300',
            'created_at' => '2022-9-16',
            ],
            ['id'  => 5,
            'numbers' => '500',
            'created_at' => '2022-9-17',
            ],
            ['id'  => 6,
            'numbers' => '400',
            'created_at' => '2022-9-18',
            ],
            ['id'  => 7,
            'numbers' => '600',
            'created_at' => '2022-9-19',
            ]
        ]);
    }
}