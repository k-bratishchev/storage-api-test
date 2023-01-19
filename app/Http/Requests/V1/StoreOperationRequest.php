<?php

namespace App\Http\Requests\V1;

use App\Rules\StorageHasProductsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOperationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'productId' => ['required', 'exists:products,id'],
            'type' => ['required', Rule::in(['I', 'O'])],
            'quantity' => ['required', 'integer', 'gte:0', new StorageHasProductsRule()],
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'product_id' => $this->productId
        ]);
    }
}
