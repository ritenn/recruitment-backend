<?php

declare(strict_types=1);

namespace Domains\Book\Repositories;


use Domains\Book\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BookRepository
{
    /**
     * @return Model
     */
    public function model(): Model
    {
        return new Book();
    }

    public function list(
        ?string $search = null,
        ?int $categoryId = null,
        int $paginate = 10
    ): LengthAwarePaginator {
        return $this->model()
            ->with('categories')
            ->when(! is_null($search), fn (Builder $builder) => $builder
                ->where(fn (Builder $builder) => $builder
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                )
            )
            ->when(! is_null($categoryId), fn (Builder $builder) => $builder
                ->whereHas('categories', fn (Builder $builder) => $builder
                    ->where('id', $categoryId))
            )
            ->paginate($paginate);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findOrFail(int $id): ?Model
    {
        return $this->model()->findOrFail($id);
    }
}
