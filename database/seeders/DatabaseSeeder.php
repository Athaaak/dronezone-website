<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin 2',
            'email' => 'admin2@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'provider',
            'email' => 'provider@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
            'role' => 'provider'
        ]);

        \App\Models\Admin::factory(1)->create();
        \App\Models\Provider::factory(1)->create();
        \App\Models\Portfolio::factory(10)->create();
        \App\Models\Inventory::factory(10)->create();
        \App\Models\Article::factory(10)->create();
    }
}
