<?php

namespace Domains\Application\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequestMain;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequest extends FormRequestMain
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }

    /**
     * @param string $name
     * @return int|null
     */
    public function getIntOrNull(string $name): ?int
    {
        return $this->get($name) ? (int) $this->get($name) : null;
    }

    /**
     * @param string $name
     * @return int|null
     */
    public function getIntOrNullFromRoute(string $name): ?int
    {
        return $this->route($name) ? (int) $this->route($name) : null;
    }
}
