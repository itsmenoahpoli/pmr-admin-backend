<?php

namespace App\Models\Patients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientIE extends Model
{
    protected $guarded = [];
    protected $table = 'patient_ie';

    public function patient_profile() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Patients\PatientProfile::class);
    }
}
