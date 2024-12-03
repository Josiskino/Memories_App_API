<?php

namespace App\Http\Requests\tourist;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTouristRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        //return auth()->check() && auth()->user()->role === 'tourist';
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
            'password' => 'required|string|min:8',
            'touristName' => 'required|string|max:100',
            'touristPhone' => 'required|string|max:15',
            'touristUserName' => 'nullable|string|max:50',
            'touristAddress' => 'nullable|string|max:255',
            'touristCity' => 'nullable|string|max:100',
            'touristCountry' => 'nullable|string|max:100',
            'touristPostalCode' => 'nullable|string|max:20',
            'touristPassport' => 'nullable|string|max:50',
            'touristPassportCountry' => 'nullable|string|max:100',
            'touristPassportDate' => 'nullable|date',
            'touristPassportNumber' => 'nullable|string|max:50',
            'touristPassportExpiry' => 'nullable|date|after:today',
            'touristPassportIssue' => 'nullable|date|before_or_equal:today',
            'touristPassportPlace' => 'nullable|string|max:100',
            'touristPassportType' => 'nullable|string|max:50',
            'touristPassportImage' => 'nullable|image|max:2048',
        ];
    }


    /**
     * Personnaliser les messages de validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // Email
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email address.',
            'email.unique' => 'This email address is already in use.',

            // Password
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least :min characters long.',
            'password.string' => 'The password must be a string.',

            // Tourist Name
            'touristName.required' => 'The tourist name is required.',
            'touristName.string' => 'The tourist name must be a string.',
            'touristName.max' => 'The tourist name may not be greater than :max characters.',

            // Tourist Phone
            'touristPhone.required' => 'The tourist phone number is required.',
            'touristPhone.string' => 'The tourist phone number must be a string.',
            'touristPhone.max' => 'The tourist phone number may not be greater than :max characters.',

            // Tourist Username
            'touristUserName.string' => 'The tourist username must be a string.',
            'touristUserName.max' => 'The tourist username may not be greater than :max characters.',

            // Tourist Address
            'touristAddress.string' => 'The tourist address must be a string.',
            'touristAddress.max' => 'The tourist address may not be greater than :max characters.',

            // Tourist City
            'touristCity.string' => 'The tourist city must be a string.',
            'touristCity.max' => 'The tourist city may not be greater than :max characters.',

            // Tourist Country
            'touristCountry.string' => 'The tourist country must be a string.',
            'touristCountry.max' => 'The tourist country may not be greater than :max characters.',

            // Tourist Postal Code
            'touristPostalCode.string' => 'The tourist postal code must be a string.',
            'touristPostalCode.max' => 'The tourist postal code may not be greater than :max characters.',

            // Tourist Passport
            'touristPassport.string' => 'The tourist passport must be a string.',
            'touristPassport.max' => 'The tourist passport may not be greater than :max characters.',

            // Tourist Passport Country
            'touristPassportCountry.string' => 'The tourist passport country must be a string.',
            'touristPassportCountry.max' => 'The tourist passport country may not be greater than :max characters.',

            // Tourist Passport Date
            'touristPassportDate.date' => 'The tourist passport date must be a valid date.',

            // Tourist Passport Number
            'touristPassportNumber.string' => 'The tourist passport number must be a string.',
            'touristPassportNumber.max' => 'The tourist passport number may not be greater than :max characters.',

            // Tourist Passport Expiry
            'touristPassportExpiry.date' => 'The tourist passport expiry must be a valid date.',
            'touristPassportExpiry.after' => 'The tourist passport expiry date must be after today.',

            // Tourist Passport Issue
            'touristPassportIssue.date' => 'The tourist passport issue must be a valid date.',
            'touristPassportIssue.before_or_equal' => 'The tourist passport issue date must be today or earlier.',

            // Tourist Passport Place
            'touristPassportPlace.string' => 'The tourist passport place must be a string.',
            'touristPassportPlace.max' => 'The tourist passport place may not be greater than :max characters.',

            // Tourist Passport Type
            'touristPassportType.string' => 'The tourist passport type must be a string.',
            'touristPassportType.max' => 'The tourist passport type may not be greater than :max characters.',

            // Tourist Passport Image
            'touristPassportImage.image' => 'The tourist passport image must be a valid image file.',
            'touristPassportImage.max' => 'The tourist passport image must not exceed :max kilobytes.',
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
