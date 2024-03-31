<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class ArrayInArrayDecimal implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $result = [];
        // dd($value);

        $array = json_decode($value, true);

        foreach ($array as $key1 => $criterion) {
            foreach ($criterion as $key2 => $criteria) {
                $result[$key1][$key2] = number_format($criteria, 3);
            }
        }

        return $result;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
