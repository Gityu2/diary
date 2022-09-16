<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id'  => 1,
            'name' => 'admin',
            'email' => 'admin'.'@'.'admin',
            'password' => Hash::make('password'),
            'role_id' => 1,
            ],
            ['id'  => 2,
            'name' => 'user',
            'email' => 'user'.'@'.'user',
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 3,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 4,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 5,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 6,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 7,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 8,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 9,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 10,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 11,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ],
            ['id'  => 12,
            'name' => Str::random(10),
            'email' => Str::random(10).'@'.Str::random(10),
            'password' => Hash::make('password'),
            'role_id' => 2,

            ]

        ]);    
    }
}
