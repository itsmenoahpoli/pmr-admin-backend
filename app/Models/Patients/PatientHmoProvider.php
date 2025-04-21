<?php

namespace App\Models\Patients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientHmoProvider extends Model
{
    protected $guarded = [];

    public function patient_hmos() : HasMany
    {
        return $this->hasMany(\App\Models\Patients\PatientHmo::class);
    }

    public function patient_profiles() : HasMany
    {
        return $this->hasMany(\App\Models\Patients\PatientProfile::class);
    }
}
