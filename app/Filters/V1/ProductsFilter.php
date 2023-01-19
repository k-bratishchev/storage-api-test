<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ProductsFilter extends ApiFilter {
    protected $safeParams = [
        'name' => ['eq'],
        'quantity' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'price' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
    ];
}
