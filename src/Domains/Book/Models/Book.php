<?php

declare(strict_types=1);

namespace Domains\Book\Models;

use Database\Factories\BookFactory;
use Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'publication_date' => 'date:Y-m-d',
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_id');
    }

    protected static function newFactory(): Factory
    {
        return BookFactory::new();
    }
}
