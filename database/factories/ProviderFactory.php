<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::where('role', 'provider')->first();

        return [
            'company_name' => fake()->company(),
            'provider_email' => fake()->email(),
            'contact' => fake()->name(),
            'division' => 'Profesional',
            'address_provider' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'description' => fake()->realText,
            'district' => 'SUKOLILO',
            'photo' => fake()->imageUrl(640, 640),
            'user_id' => $user->id
        ];
    }
}
