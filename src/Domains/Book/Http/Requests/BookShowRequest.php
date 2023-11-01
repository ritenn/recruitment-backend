<?php

namespace Domains\Book\Http\Requests;


use Domains\Application\Http\Requests\FormRequest;

class BookShowRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
