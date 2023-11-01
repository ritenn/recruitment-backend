<?php

namespace Domains\Book\Http\Requests;


use Domains\Application\Http\Requests\FormRequest;

class BookDestroyRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
