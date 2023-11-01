<?php

declare(strict_types=1);

namespace Domains\Book\DTO;


use Carbon\Carbon;
use Domains\Application\DTO\BaseDTO;

class BookDTO extends BaseDTO
{
    public ?int $id = null;
    public string $name;
    public string $author;
    public Carbon $publicationDate;
    public string $description;
    public int $stock;
}
