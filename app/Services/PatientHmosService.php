<?php

namespace App\Services;

use App\Models\Patients\PatientHmo;
use App\Repositories\PatientHmosRepository;


class PatientHmosService extends PatientHmosRepository
{
    public function __construct()
    {
        parent::__construct(new PatientHmo(), ['patient_hmo_provider', 'patient_profile']);
    }
}
