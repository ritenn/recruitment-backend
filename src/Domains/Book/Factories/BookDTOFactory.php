<?php

declare(strict_types=1);

namespace Domains\Book\Factories;


use Carbon\Carbon;
use Domains\Book\DTO\BookDTO;
use Illuminate\Http\Request;

class BookDTOFactory
{
    /**
     * @param Request $request
     * @return BookDTO
     */
    public static function makeFromRequest(Request $request): BookDTO
    {
        return BookDTO::make([
            'id' => $request->getIntOrNullFromRoute('book'),
            'name' => $request->get('name'),
            'author' => $request->get('author'),
            'description' => $request->get('description'),
            'stock' => $request->get('stock'),
            'publication_date' => Carbon::parse($request->get('publication_date')),
        ]);
    }
}
