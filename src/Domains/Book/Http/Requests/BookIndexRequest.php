<?php

namespace Domains\Book\Http\Requests;


use Domains\Application\Http\Requests\FormRequest;

class BookIndexRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'search' => [
                'nullable',
                'string',
                'max:255'
            ],
            'category_id' => [
                'nullable',
                'exists:categories,id'
            ],
        ];
    }
}
