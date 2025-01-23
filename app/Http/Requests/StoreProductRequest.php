<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => ['required',],
            'quantity' => ['nullable','numeric'],
            'purchase_price' => ['nullable','numeric'],
            'sale_price' => ['required', 'numeric'],
            'unit' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable'],
        ];
    }
}
