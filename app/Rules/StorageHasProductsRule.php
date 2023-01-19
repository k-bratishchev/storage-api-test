<?php

namespace App\Rules;

use App\Models\Product;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class StorageHasProductsRule implements DataAwareRule, InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $productsQuantity = Product::where('id', $this->data['productId'])->first()->quantity;

        if ($this->data['type'] === 'O' && $value > $productsQuantity ) {
            $fail('There are not enough products in the storage');
        }
    }

    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    }
}
