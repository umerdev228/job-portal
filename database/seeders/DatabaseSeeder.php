<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProviderProfile;
use App\Models\SeekerProfile;
use Carbon\Carbon;
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
        $provider = \App\Models\User::create([
            'first_name' => 'Job',
            'last_name' => 'Provider',
            'email' => 'provider@mail.com',
            'password' => Hash::make(123456789),
            'role' => 'provider',
            'image' => '/images/default.png',
        ]);
        ProviderProfile::create([
            'user_id' =>  $provider->id,
            'company_name' => 'Company',
        ]);

        /*Seeker*/
        $seeker = \App\Models\User::create([
            'first_name' => 'Job',
            'last_name' => 'Seeker',
            'email' => 'seeker@mail.com',
            'password' => Hash::make(123456789),
            'role' => 'seeker',
            'image' => '/images/default.png',
        ]);
        SeekerProfile::create([
           'user_id' =>  $seeker->id,
           'gender' =>  'male',
           'dob' =>  Carbon::parse('1-1-2000'),
           'phone' =>  '+9212345678',
        ]);

        $this->call([
            RoleSeeder::class
        ]);
    }
}
