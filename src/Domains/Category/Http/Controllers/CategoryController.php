<?php

declare(strict_types=1);

namespace Domains\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Domains\Category\Repositories\CategoryRepository;
use Domains\Category\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        private readonly CategoryRepository $categoryRepository
    ) {}

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(
            $this->categoryRepository->list()
        );
    }
}
