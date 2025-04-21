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
            'patient_hmo_providers'   => $hmoProvidersCount,
            'patient_hmos'            => $patientHmosCount,
            'patient_profiles'        => $patientProfilesCount,
            'recent_logins'           => $recentLogins
        ];
    }
}
