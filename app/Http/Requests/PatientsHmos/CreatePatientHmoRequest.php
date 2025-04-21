<?php

namespace App\Http\Requests\PatientsHmos;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientHmoRequest extends FormRequest
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
            'patient_profile_id'      => 'required|exists:patient_profiles,id',
            'patient_hmo_provider_id' => 'nullable|exists:patient_hmo_providers,id',
            'hmo_account_no'          => 'required|string',
            'hmo_policy_no'           => 'required|string',
            'hmo_dependents'          => 'required|array',
            'card_photo'              => 'nullable|file:image',
            'status'                  => 'required|in:active,inactive'
        ];
    }
}
