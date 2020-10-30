<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->isbn13,
            'name' => $this->faker->sentence(3, true),
            'remark' => $this->faker->sentence(),
            'quantity' => $this->faker->randomNumber(2, true),
            'price' => $this->faker->randomFloat(2, 0, 999),
            'image_url' => $this->faker->imageUrl(640, 480, 'food'),
        ];
    }
}
