<?php

namespace App\Http\Requests\transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'reservation_id' => 'required|exists:reservations,id',
            //'amount'         => 'required|numeric|min:1',
            'network'        => 'required|string|in:FLOOZ,TMONEY',
            'phone_number'   => 'required|string',
            //'identifier'     => 'required|string|unique:transactions,identifier',
            'transaction_details' => 'nullable|string',
        ];
    }
}
