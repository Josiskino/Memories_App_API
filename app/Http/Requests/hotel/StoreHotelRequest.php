<?php

namespace App\Http\Requests\hotel;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
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
            'hotelName' => 'required|string|max:255',
            'hotelCity' => 'required|string|max:255',
            'hotelEmail' => 'required|string|email|max:255|unique:hotels,hotelEmail',
            'hotelPhone' => 'required|string|max:20',
            'main_photo' => 'required|integer|min:0',
        ];
    }
}
