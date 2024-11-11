<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = ['post01.jpg','post02.jpg','post03.jpg','post04.jpg','post05.jpg','post06.jpg','post07.jpg','post08.jpg'];
        return [
            'user_id' => User::factory(),
            'image' => 'posts/' . fake()->randomElement($images),
            'description' => fake()->paragraph(5),
            'slug' => fake()->regexify('[A-Z0-9]{10}'),
            

        ];
    }
}
