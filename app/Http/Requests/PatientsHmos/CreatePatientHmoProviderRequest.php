<?php

namespace App\Http\Requests\PatientsHmos;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientHmoProviderRequest extends FormRequest
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
            'name'          => 'string|required|unique:patient_hmo_providers',
            'logo_file'     => 'nullable|file:image',
            'contact_person' => 'string|required',
            'contact_person_email' => 'email|required',
            'contact_person_phone' => 'string|required',
            'is_enabled'    => 'boolean|nullable'
        ];
    }
}
