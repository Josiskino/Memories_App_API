<?php

namespace App\Http\Requests\reservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //'startDate' => 'required|date|after_or_equal:today',
            //'endDate' => 'required|date|after:startDate',
            'startDate' => ['required', 'date', 'after_or_equal:today'],
            'endDate' => ['nullable', 'date', 'after_or_equal:startDate'],
            'reservable_type' => 'required|string|in:tourism_site,hotel',
            //'reservable_type' => 'required|string|in:App\\Models\\TourismSite,App\\Models\\Hotel', 
            //'reservable_id' => 'required|integer|exists:tourims_sites,id', 
            'reservable_id' => 'required|integer',
            //'tourist_id' => 'required|integer|exists:tourists,id',
            //'status' => 'nullable|integer|in:0,1',
            'status' => ['sometimes', 'integer', 'in:0,1,2'],
            'amount' => 'required|numeric|min:1',
            'reservationTime' => ['nullable', 'date_format:H:i'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $reservableTypeMap = [
                'tourism_site' => 'tourims_sites',
                'hotel' => 'hotels',
            ];

            $reservableType = $this->reservable_type;
            $reservableId = $this->reservable_id;

            if (isset($reservableTypeMap[$reservableType])) {
                $table = $reservableTypeMap[$reservableType];
                $exists = DB::table($table)->where('id', $reservableId)->exists();

                if (!$exists) {
                    $validator->errors()->add('reservable_id', "The reservable_id does not exist in the $table table.");
                }
            } else {
                $validator->errors()->add('reservable_type', 'Invalid reservable_type provided.');
            }
        });
    }
}
