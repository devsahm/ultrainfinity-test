<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    protected $model = Article::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $images = ["https://via.placeholder.com/300/09f/fff.png", "https://via.placeholder.com/150/FF0000/FFFFFF"];

        return [
            'subject' => $this->faker->word,
            'body' => $this->faker->sentence(20),
            'image' => $images[array_rand($images)]
        ];
    }
}
