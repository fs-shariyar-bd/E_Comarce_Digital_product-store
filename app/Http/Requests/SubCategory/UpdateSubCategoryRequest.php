<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubCategoryRequest extends FormRequest
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
        $categoryId = $this->input('category_id');
        $subCategoryId = $this->route('id'); // Assuming route parameter is {id}

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories')->where(function ($query) use ($categoryId) {
                    return $query->where('category_id', $categoryId);
                })->ignore($subCategoryId),
            ],
            'order' => [
                'required',
                'integer',
                Rule::unique('sub_categories')->where(function ($query) use ($categoryId) {
                    return $query->where('category_id', $categoryId);
                })->ignore($subCategoryId),
            ],
            'status' => 'required|boolean',
        ];
    }
}