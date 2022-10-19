<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');

        User::create([
            
                'id'   =>1,
                'name' => 'admin',
                'email' => 'admin'.'@'.'admin',
                'password' => Hash::make('password'),
                'role_id' => 1,
        ]);

        User::create([
            
                'id'   =>2,
                'name' => 'user',
                'email' => 'user'.'@'.'user',
                'password' => Hash::make('password'),
                'role_id' => 2,

        ]);

        for($i = 0; $i < 48; $i++){
            User::create([
                'name' => $faker->userName,
                'email' => $faker->safeEmail,
                'password' => Hash::make('password'),
                'role_id' => 2,
            ]);
        }
    }
}
