<?php

declare(strict_types=1);

namespace Domains\Book\Http\Resources;

use Domains\Category\Resources\CategorySimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookSimpleResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'author' => $this->resource->author,
            'stock' => $this->resource->stock,
            'category' => CategorySimpleResource::collection($this->resource->categories)
        ];
    }
}
