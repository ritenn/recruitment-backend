<?php

declare(strict_types=1);

namespace Domains\Book\Jobs;

use Domains\Book\Repositories\BookRepository;

class DeleteBookJob
{
    public function __construct(
        private readonly int $bookId,
    ) {}

    public function handle(BookRepository $bookRepository): void
    {
        $book = $bookRepository->findOrFail($this->bookId);
        $book->delete();
    }
}
