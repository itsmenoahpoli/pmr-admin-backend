<?php

namespace App\Models\Patients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientHmo extends Model
{
    protected $guarded = [];

    public function casts()
    {
        return [
            'hmo_dependents' => 'array'
        ];
    }

    public function patient_profile() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Patients\PatientProfile::class);
    }

    public function patient_hmo_provider() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Patients\PatientHmoProvider::class);
    }
}
