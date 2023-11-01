<?php

declare(strict_types=1);

namespace Domains\Book\Http\Controllers;

use App\Http\Controllers\Controller;
use Domains\Book\Factories\BookDTOFactory;
use Domains\Book\Http\Requests\BookDestroyRequest;
use Domains\Book\Http\Requests\BookIndexRequest;
use Domains\Book\Http\Requests\BookShowRequest;
use Domains\Book\Http\Requests\BookStoreRequest;
use Domains\Book\Http\Requests\BookUpdateRequest;
use Domains\Book\Http\Resources\BookResource;
use Domains\Book\Http\Resources\BookSimpleResource;
use Domains\Book\Jobs\CreateBookJob;
use Domains\Book\Jobs\DeleteBookJob;
use Domains\Book\Jobs\UpdateBookJob;
use Domains\Book\Repositories\BookRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Bus;

class BookController extends Controller
{
    /**
     * @param BookRepository $bookRepository
     */
    public function __construct(
        private readonly BookRepository $bookRepository
    ) {}

    /**
     * @param BookIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(BookIndexRequest $request): AnonymousResourceCollection
    {
        return BookSimpleResource::collection(
            $this->bookRepository->list(
                $request->get('search'),
                $request->getIntOrNull('category_id'),
            )
        );
    }

    /**
     * @param BookShowRequest $request
     * @param int $bookId
     * @return BookResource
     */
    public function show(BookShowRequest $request, int $bookId): BookResource
    {
        return new BookResource($this->bookRepository->findOrFail($bookId));
    }

    /**
     * @param BookStoreRequest $request
     * @return BookResource
     */
    public function store(BookStoreRequest $request): BookResource
    {
        $book = new CreateBookJob(
            BookDTOFactory::makeFromRequest($request),
            $request->getIntOrNull('category_id')
        );

        Bus::dispatchNow($book);

        return new BookResource($book->getModel());
    }

    /**
     * @param BookUpdateRequest $request
     * @return BookResource
     */
    public function update(BookUpdateRequest $request): BookResource
    {
        $book = new UpdateBookJob(
            BookDTOFactory::makeFromRequest($request),
            $request->getIntOrNull('category_id')
        );

        Bus::dispatchNow($book);

        return new BookResource($book->getModel());
    }

    /**
     * @param BookDestroyRequest $request
     * @param int $bookId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BookDestroyRequest $request, int $bookId)
    {
        Bus::dispatchNow(new DeleteBookJob($bookId));

        return response()->json(['message' => 'success'], 200);
    }
}
