<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'products' => ['required', 'array'],
            'products.*.product_id' => ['required', 'exists:products,id'],
            'products.*.product_title' => ['required', 'string'], // Проверяем, что product_title передаётся
            'products.*.quantity' => ['nullable', 'numeric', 'min:0'],
            'products.*.price' => ['nullable', 'numeric', 'min:0'],
            'products.*.total_price' => ['required', 'numeric'],
        ];
    }
}
