<?php

namespace App\Http\Requests\tourism_category;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourismCategoryRequest extends FormRequest
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
            'categoryName' => 'required|string|max:255',
            'categoryDescription' => 'nullable|string',
        ];
    }

    /**
     * Messages de validation personnalisés (optionnel).
     */
    public function messages(): array
    {
        return [
            'categoryName.required' => 'The category name is required.',
            'categoryName.string' => 'The category name must be a string.',
            'categoryName.max' => 'The category name may not exceed 255 characters.',
            'categoryDescription.string' => 'The description must be a string.',
        ];
    }
}
