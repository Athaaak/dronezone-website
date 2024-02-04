<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = Admin::first();

        $title = fake()->text(30);
        return [
            'title' => $title,
            'description' => fake()->text(200),
            'image' => fake()->imageUrl(640, 640),
            'slug' => Str::slug($title),
            'admin_id' => $user->id
        ];
    }
}
