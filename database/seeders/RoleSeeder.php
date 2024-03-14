<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::create([
            'name' => 'admin',
            'status' => Role::STATUS_ACTIVE,
        ]);

        Role::create([
            'name' => 'seeker',
            'status' => Role::STATUS_ACTIVE,
        ]);

        Role::create([
            'name' => 'provider',
            'status' => Role::STATUS_ACTIVE,
        ]);

    }
}
