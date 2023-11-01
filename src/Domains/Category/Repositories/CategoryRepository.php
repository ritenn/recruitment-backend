<?php

declare(strict_types=1);

namespace Domains\Category\Repositories;


use Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryRepository
{
    /**
     * @return Model
     */
    public function model(): Model
    {
        return new Category();
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->model()
            ->orderBy('order')
            ->get();
    }
}
