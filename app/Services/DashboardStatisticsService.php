<?php

namespace App\Services;

use App\Services\PatientHmoProvidersService;
use App\Services\PatientHmosService;
use App\Services\PatientProfilesService;
use App\Services\UserSessionsService;

class DashboardStatisticsService
{
    public function __construct(
        private readonly PatientHmoProvidersService $patientHmoProvidersService,
        private readonly PatientHmosService $patientHmosService,
        private readonly PatientProfilesService $patientProfilesService,
        private readonly UserSessionsService $userSessionsService
    )
    {}

    public function getOverallStatistics()
    {
        $hmoProvidersCount = $this->patientHmoProvidersService->model->count();
        $patientHmosCount = $this->patientHmosService->model->count();
        $patientProfilesCount = $this->patientProfilesService->model->count();

        $recentLogins = $this->userSessionsService->getList(5);

        return [
            'total_patient_profiles'            => $patientProfilesCount,
            'total_patient_hmos'                => $patientHmosCount,
            'total_hmo_providers'               => $hmoProvidersCount,
            'total_staff_physical_therapists'   => 0,
            'total_staff_clinic_doctors'        => 0,
            'total_users'                       => 0,
            'total_roles'                       => 0,
            'recent_logins'                     => $recentLogins
        ];
    }
}
