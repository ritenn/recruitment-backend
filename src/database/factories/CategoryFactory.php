<?php

namespace Database\Factories;

use Domains\Book\Models\Book;
use Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    private int $order = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * @return array|mixed[]
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'order' => $this->order++,
        ];
    }
}
