<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductsFilter extends ApiFilter {

    protected $safeParams = [
        'id' => self::ID_FILTERS,
        'name' => self::STRING_FILTERS,
        'quantity' => self::NUMBER_FILTERS,
        'price' => self::NUMBER_FILTERS,
    ];

    public function transformQuery(Builder $query, Request $request) {
        $query = parent::transformQuery($query, $request);
        
        $properties = $request->query('properties');

        if (!isset($properties)) {
            return $query;
        }

        foreach ($properties as $property => $values) {
            $query->whereIn("properties->$property", $values);
        }

        return $query;
    }
}
