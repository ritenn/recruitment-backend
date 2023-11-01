<?php

declare(strict_types=1);

namespace Domains\Book\Jobs;


use Domains\Book\Repositories\BookRepository;

class UpdateBookJob extends CreateBookJob
{
    /**
     * @param BookRepository $bookRepository
     * @return void
     */
    public function handle(BookRepository $bookRepository): void
    {
        $this->storeBook($bookRepository->findOrFail($this->bookDTO->id));
        $this->updateCategory();

        $this->book->refresh();
    }
}
