<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class OperationFilter extends ApiFilter {
    protected $safeParams = [
        'productId' => self::ID_FILTERS,
        'quantity' => self::NUMBER_FILTERS,
        'type' => ['eq'],
    ];

    protected $columnMap = [
        'productId' => 'product_id'
    ];
}
