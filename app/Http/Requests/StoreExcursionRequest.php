<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExcursionRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'agency';
    }

    public function forbiddenResponse()
    {
        return response()->json([
            'status_code' => 403,
            'status_message' => 'You are not authorized to perform this action.',
        ], 403);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'excursionName' => 'required|string|max:255',
            'excursionDescription' => 'nullable|string',
            'excursionDate' => 'required|date',
            'excursionTime' => 'required|date_format:H:i',  
            'excursionPlace' => 'required|string|max:255',
            'excursionPrice' => 'required|numeric',
            'excursionMaxParticipants' => 'required|integer',
            'tourism_site_id' => 'required|exists:tourims_sites,id',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'excursionName.required' => 'The excursion name is required.',
            'excursionName.string' => 'The excursion name must be a string.',
            'excursionName.max' => 'The excursion name may not be greater than 255 characters.',
            
            'excursionDescription.string' => 'The excursion description must be a string.',
            
            'excursionDate.required' => 'The excursion date is required.',
            'excursionDate.date' => 'The excursion date must be a valid date.',
            
            'excursionTime.required' => 'The excursion time is required.',
            'excursionTime.date_format' => 'The excursion time must be in the format HH:mm.',
            
            'excursionPlace.required' => 'The excursion place is required.',
            'excursionPlace.string' => 'The excursion place must be a string.',
            'excursionPlace.max' => 'The excursion place may not be greater than 255 characters.',
            
            'excursionPrice.required' => 'The excursion price is required.',
            'excursionPrice.numeric' => 'The excursion price must be a number.',
            
            'excursionMaxParticipants.required' => 'The maximum number of participants is required.',
            'excursionMaxParticipants.integer' => 'The maximum number of participants must be an integer.',
            
            'status.required' => 'The excursion status is required.',
            'status.in' => 'The excursion status must be either "active" or "inactive".',
        ];
    }
}
