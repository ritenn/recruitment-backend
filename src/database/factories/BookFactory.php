<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Book\Models\Book;
use Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * @return array|mixed[]
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(1),
            'author' => sprintf('%s %s', $this->faker->firstName, $this->faker->lastName),
            'publication_date' => $this->faker->date(),
            'description' => $this->faker->text(250),
            'stock' => $this->faker->numberBetween(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Book $book) {
           $book->categories()->sync(Category::inRandomOrder()->first()->id);
        });
    }
}
