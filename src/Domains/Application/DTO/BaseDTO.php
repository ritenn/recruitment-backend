<?php

declare(strict_types=1);

namespace Domains\Application\DTO;


use Illuminate\Support\Str;

class BaseDTO
{
    /**
     * @param array $data
     * @return self
     */
    public static function make(array $data): self
    {
        $caller = get_called_class();
        $dto = new $caller();

        foreach($data as $key => $value) {
            $property = Str::camel($key);

            if (property_exists($dto, $property)) {
                $dto->{$property} = $value;
            }
        }

        return $dto;
    }
}
