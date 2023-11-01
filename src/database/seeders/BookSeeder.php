<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domains\Book\Models\Book;
use Domains\Category\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory()
            ->count(200)
            ->create();
    }
}
