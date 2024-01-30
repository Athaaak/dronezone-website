<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provider = Provider::first();

        return [
            'title' => fake()->text(50),
            'description' => fake()->text(200),
            'photo' => fake()->imageUrl(640, 640),
            'video_url' => fake()->imageUrl(640, 640),
            'provider_id' => $provider->id,
        ];
    }
}
