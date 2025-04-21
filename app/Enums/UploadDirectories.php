<?php

namespace App\Enums;

enum UploadDirectories : string
{
    case PATIENT_PROFILE_PHOTO_DIR = '/uploads/patients/profile-photos';
    case HMO_PROVIDER_LOGO_DIR = '/uploads/hmo-providers/logos';
}
