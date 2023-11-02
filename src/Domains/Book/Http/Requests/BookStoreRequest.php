<?php

namespace Domains\Book\Http\Requests;


use Domains\Application\Http\Requests\FormRequest;

class BookStoreRequest extends FormRequest
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
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'author' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'publication_date' => [
                'required',
                'date:Y-m-d',
            ],
            'description' => [
                'required',
                'string',
                'min:1',
                'max:500',
            ],
            'stock' => [
                'required',
                'numeric',
                'min:0',
                'max:4294967295',
            ],
            'category_id' => [
                'required',
                'exists:categories,id'
            ],
        ];
    }
}
