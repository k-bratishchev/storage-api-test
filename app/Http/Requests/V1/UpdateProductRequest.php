<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'name' => ['required']    ,
                'quantity' => ['required', 'integer', 'gte:0'],
                'price' => ['required', 'integer', 'gte:0'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required']    ,
                'quantity' => ['sometimes', 'required', 'integer', 'gte:0'],
                'price' => ['sometimes', 'required', 'integer', 'gte:0'],
            ];
        }

    }
}
