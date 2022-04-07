<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
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
    protected $model = Post::class;
    public function definition()
    {
        return [
            //esto sera lo aleatorio q tendra el usuario adminisittrador
            'user_id' => 1,
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->text(),
            'body' => $this->faker->text(800),
        ];
    }
}
