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
    public function definition()
    {
        $users = User::all();
        $users = $users->pluck('id')->toArray();
        $posts = config('posts');

        return [
            'user_id' => fake()->randomElement($users),
            'name' => fake()->sentence,
            'text' => fake()->text(600),
            'type' => fake()->randomElement(array_flip($posts['type'])),
            'status' => fake()->randomElement(array_flip($posts['status'])),
        ];
    }
}
