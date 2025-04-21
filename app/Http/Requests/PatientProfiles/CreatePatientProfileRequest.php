<?php

namespace App\Http\Requests\PatientProfiles;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientProfileRequest extends FormRequest
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
            'patient_hmo_provider_id' => 'nullable|exists:patient_hmo_providers,id',
            'profile_photo_file'      => 'nullable|image',
            'first_name'              => 'required|string|max:255',
            'middle_name'             => 'nullable|string|max:255',
            'last_name'               => 'required|string|max:255',
            'gender'                  => 'required|in:male,female',
            'birthdate'               => 'required|string',
            'contact_mobile'          => 'required|string|max:255|unique:patient_profiles',
            'contact_landline'        => 'nullable|string|max:255',
            'contact_email'           => 'required|email|max:255|unique:patient_profiles',
            'address_line1'           => 'required|string',
            'address_line2'           => 'nullable|string',
            'address_city'            => 'required|string|max:255',
            'address_province'        => 'required|string|max:255',
            'address_zipcode'         => 'required|string|max:255',
            'address_country'         => 'nullable|string|size:2',
            'status'                  => 'required|in:active,inactive'

            // TODO: Add patient HMO details (if included in the payload)
        ];
    }
}
