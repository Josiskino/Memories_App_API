<?php

namespace App\Http\Requests\tourism_site;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourismSiteRequest extends FormRequest
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
            'tourismeSiteName' => 'required|string|max:255',
            'tourismeSiteCity' => 'required|string|max:255',
            'tourismeSiteDescription' => 'nullable|string',
            'tourismeSiteEnterPrice' => 'nullable|numeric',
            'tourismeSiteWebSite' => 'nullable|string|max:255',
            'tourismeSitePhoneNumber' => 'nullable|string|max:20',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'status' => 'nullable|integer',
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048',
            'main_photo' => 'required|integer|min:0',
            'rating' => 'nullable|numeric|between:0,5',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'tourism_category_id' => 'required|integer|exists:tourism_categories,id',
        ];
    }


    public function messages()
    {
        return [
            'tourismeSiteName.required' => 'The site name is required.',
            'tourismeSiteCity.required' => 'The site city is required.',
            'latitude.required' => 'The latitude is required.',
            'longitude.required' => 'The longitude is required.',
            'photos.required' => 'At least one photo is required.',
            'photos.*.image' => 'Each file must be an image.',
            'photos.*.mimes' => 'Each image must be of type jpeg, png, jpg, gif, or svg.',
            'main_photo.required' => 'You must specify which photo is the main photo.',
            'main_photo.integer' => 'The main photo indicator must be an integer.',
        ];
    }
}
