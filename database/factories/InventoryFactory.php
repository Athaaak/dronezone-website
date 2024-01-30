<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
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
            'spesification' => fake()->text(200),
            'detail_inventory' => fake()->text(200),
            'special_feature' => fake()->text(200),
            'photo' => fake()->imageUrl(640, 640),
            'provider_id' => $provider->id,
        ];
    }
}
