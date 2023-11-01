<?php

namespace Domains\Book\Http\Requests;


use Domains\Application\Http\Requests\FormRequest;

class BookUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'min:1',
                'max:255',
            ],
            'author' => [
                'nullable',
                'string',
                'min:1',
                'max:255',
            ],
            'publication_date' => [
                'nullable',
                'date:Y-m-d',
            ],
            'description' => [
                'nullable',
                'string',
                'min:1',
                'max:65535',
            ],
            'stock' => [
                'nullable',
                'numeric',
                'min:0',
                'max:4294967295',
            ],
            'category_id' => [
                'nullable',
                'exists:categories,id'
            ],
        ];
    }
}
