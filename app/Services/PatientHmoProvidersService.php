<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Enums\UploadDirectories;
use App\Models\Patients\PatientHmoProvider;
use App\Repositories\PatientHmoProvidersRepository;
use App\Traits\FilesHelper;

const HMO_PROVIDER_LOGO_DIR = UploadDirectories::HMO_PROVIDER_LOGO_DIR->value;

class PatientHmoProvidersService extends PatientHmoProvidersRepository
{
    use FilesHelper;

    public function __construct()
    {
        parent::__construct(new PatientHmoProvider(), ['patient_hmos']);
    }

    public function create($data)
    {
        $data['name'] = strtoupper($data['name']);
        $data['name_slug'] = Str::slug($data['name']);
        $data['is_enabled'] = isset($data['is_enabled']) && $data['is_enabled'] ? true : false;

        if (isset($data['logo_file'])) {
            $file = $data['logo_file'];
            $filename = time().Str::slug($data['name']). '_' . $file->getClientOriginalName();

            $path = $this->uploadFile(
                HMO_PROVIDER_LOGO_DIR,
                $filename,
                $file
            );

            unset($data['logo_file']);
            $data['logo_src'] = $path;
        }

        return parent::create($data);
    }
}
