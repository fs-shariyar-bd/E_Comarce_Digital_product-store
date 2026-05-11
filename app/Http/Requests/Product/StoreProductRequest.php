<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->input('category_id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->where(function ($query) use ($categoryId) {
                    return $query->where('category_id', $categoryId);
                }),
            ],
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'product_details' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'delivery_policy' => 'nullable|string|max:255',
            'return_policy' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'order' => [
                'required',
                'integer',
                Rule::unique('products')->where(function ($query) use ($categoryId) {
                    return $query->where('category_id', $categoryId);
                }),
            ],
            'status' => 'required|boolean',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}