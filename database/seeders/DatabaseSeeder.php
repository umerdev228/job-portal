<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
         \App\Models\Skill::factory(10)->create();
         \App\Models\Category::factory(10)->create();

        /*Admin*/
        \App\Models\User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make(123456789),
            'role' => 'admin',
            'image' => '/images/default.png',
        ]);

        /*Provider*/
        \App\Models\User::create([
            'first_name' => 'Job',
            'last_name' => 'Provider',
            'email' => 'provider@mail.com',
            'password' => Hash::make(123456789),
            'role' => 'provider',
            'image' => '/images/default.png',
        ]);

        /*Seeker*/
        \App\Models\User::create([
            'first_name' => 'Job',
            'last_name' => 'Seeker',
            'email' => 'seeker@mail.com',
            'password' => Hash::make(123456789),
            'role' => 'seeker',
            'image' => '/images/default.png',
        ]);

        $this->call([
            RoleSeeder::class
        ]);
    }
}
