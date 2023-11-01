<?php

declare(strict_types=1);

namespace Domains\Book\Jobs;


use Domains\Book\DTO\BookDTO;
use Domains\Book\Models\Book;
use Domains\Book\Repositories\BookRepository;

class CreateBookJob
{
    /**
     * @var Book|null
     */
    protected ?Book $book = null;

    /**
     * @param BookDTO $bookDTO
     * @param int $categoryId
     */
    public function __construct(
        protected readonly BookDTO $bookDTO,
        protected readonly int $categoryId,
    ) {}

    public function handle(BookRepository $bookRepository): void
    {
        $this->storeBook(new Book);
        $this->updateCategory();

        $this->book->refresh();
    }

    /**
     * @return void
     */
    protected function storeBook(Book $book): void
    {
        $this->book = $book;
        $this->book->name = $this->bookDTO->name;
        $this->book->author = $this->bookDTO->author;
        $this->book->publication_date = $this->bookDTO->publicationDate;
        $this->book->description = $this->bookDTO->description;
        $this->book->stock = $this->bookDTO->stock;
        $this->book->save();
    }

    /**
     * @return void
     */
    protected function updateCategory(): void
    {
        $this->book->categories()->sync([$this->categoryId]);
        $this->book->load('categories');
    }

    /**
     * @return Book|null
     */
    public function getModel(): ?Book
    {
        return $this->book;
    }
}
