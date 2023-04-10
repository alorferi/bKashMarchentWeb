<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_title' => $this->faker->sentence(),
            'post_content' => $this->faker->text(),
            'post_excerpt' => '',
            'to_ping' => '',
            'pinged' => '',
            'post_content_filtered' => '',
            'post_content_filtered' => '',
            'post_author'=>  User::factory(),
        ];
    }
}
