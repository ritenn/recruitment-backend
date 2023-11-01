<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domains\Category\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()
            ->count(10)
            ->create();
    }
}
