<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => 1234567890,
            'gender' => 'female',
            'qualification' => 'masters',
            'password' => Hash::make(12345678),
            'role_id' => 1
        ]);

        
        for($i=0;$i<10;$i++)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => 1234567890,
                'gender' => 'female',
                'qualification' => 'masters',
                'password' => Hash::make($faker->password),
                'role_id' => 2
            ]);
        }
    }
}
