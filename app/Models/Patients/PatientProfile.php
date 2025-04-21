<?php

namespace App\Models\Patients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientProfile extends Model
{
    protected $guarded = [];

    public function patient_hmo_provider() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Patients\PatientHmoProvider::class);
    }

    public function patient_hmo() : HasOne
    {
        return $this->hasOne(\App\Models\Patients\PatientHmo::class);
    }
}
