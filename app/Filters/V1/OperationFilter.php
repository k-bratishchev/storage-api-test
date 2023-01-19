<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class OperationFilter extends ApiFilter {
    protected $safeParams = [
        'productId' => ['eq'],
        'quantity' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'type' => ['eq'],
    ];

    protected $columnMap = [
        'productId' => 'product_id'
    ];
}
