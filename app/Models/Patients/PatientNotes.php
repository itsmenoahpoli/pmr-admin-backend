<?php

namespace App\Models\Patients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientNotes extends Model
{
    protected $guarded = [];

    public function patient_profile() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Patients\PatientNotes::class);
    }
}
