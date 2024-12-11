<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients',
            'phone' => 'required|string|max:15|
            regex:/^(?:\+1[-.\s]?)?(?:\(?[2-9]\d{2}\)?[-.\s]?)?[2-9]\d{2}[-.\s]?\d{4}$/',
            'document_photo' => 'required|image|max:2048|mimes:jpg,jpeg,png',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone.required' => 'The phone number field is required.',
            'phone.regex' => 'The phone number must be a valid US phone number format.',
            'document_photo.required' => 'A document photo is required.',
            'document_photo.image' => 'The uploaded file must be an image.',
            'document_photo.mimes' => 'Only JPG, JPEG, and PNG formats are allowed.',
            'document_photo.max' => 'The document photo must not exceed 2MB in size.',
        ];
    }
}
