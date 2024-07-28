<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreAgencyRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'agencyName' => 'required|string|max:100',
            'agencyResponsibleName'  => 'required|string|max:100',
            'agencyAttestation' => 'nullable|string|max:255',
            'agencyAddress' => 'nullable|string|max:255',
            'agencyPhone' => 'nullable|string|max:255',
            'agencyLogo' => 'nullable|string|max:255',
            'status' => 'nullable|integer',
        ];
    }

    /**
     * Personnaliser les messages de validation.
     *
     * @return array
     */
    public function messages(){
        return [
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least :min characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'touristName.required' => 'The tourist name is required.',
            'touristName.string' => 'The tourist name must be a string.',
            'touristName.max' => 'The tourist name may not be greater than :max characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'status_code' => '422',
            'status_message' => 'Validation Error',
            'errors' => $errors,
        ], 422));
    }
}
