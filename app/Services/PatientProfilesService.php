<?php

namespace App\Services;

use App\Enums\UploadDirectories;
use App\Models\Patients\PatientProfile;
use App\Repositories\PatientProfilesRepository;
use App\Services\PatientHmosService;
use App\Traits\FilesHelper;

const PATIENT_PROFILE_PHOTO_DIR = UploadDirectories::PATIENT_PROFILE_PHOTO_DIR->value;

class PatientProfilesService extends PatientProfilesRepository
{
    use FilesHelper;

    public $patientHmosService;

    public function __construct()
    {
        parent::__construct(new PatientProfile(), ['patient_hmo_provider', 'patient_hmo']);

        $this->patientHmosService = new PatientHmosService();
    }

    public function create($data)
    {
        $data['uid'] = strtoupper('PATIENT'.time());
        $data['patient_hmo_provider_id'] = isset($data['patient_hmo_provider_id']) ? $data['patient_hmo_provider_id'] : null;

        if (!$data['address_country'])
        {
            $data['address_country'] = 'PH';
        }

        if (isset($data['profile_photo_file'])) {
            $file = $data['profile_photo_file'];
            $filename = time().$data['uid']. '_' . $file->getClientOriginalName();

            $path = $this->uploadFile(
                PATIENT_PROFILE_PHOTO_DIR,
                $filename,
                $file
            );


            $data['profile_photo'] = $path;
        }

        unset($data['profile_photo_file']);

        return parent::create($data);
    }
}
