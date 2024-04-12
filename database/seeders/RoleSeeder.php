<?php

namespace Database\Seeders;

use App\Models\RoleId;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleId::create([
            'name' => 'Admin',
        ]);
        RoleId::create([
            'name' => 'Teacher',
        ]);
        RoleId::create([
            'name' => 'Monitor',
        ]);
        RoleId::create([
            'name' => 'Students',
        ]);

    }
}
