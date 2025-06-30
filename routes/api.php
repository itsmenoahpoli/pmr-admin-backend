<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Users\UsersController;
use App\Http\Controllers\Api\Users\UserRolesController;
use App\Http\Controllers\Api\Users\UserSessionsController;
use App\Http\Controllers\Api\DashboardStatisticsController;
use App\Http\Controllers\Api\Patients\PatientHmoProvidersController;
use App\Http\Controllers\Api\Patients\PatientProfilesController;
use App\Http\Controllers\Api\Patients\PatientHmosController;
use App\Http\Controllers\Api\Staffs\StaffsController;

Route::prefix('v1')->group(function() {
    /**
     * System routes
     */
    Route::prefix('system')->group(function() {
        Route::get('healthcheck', [SystemController::class, 'healthcheck'])->name('system.healthcheck');
    });

    /**
     * Authentication routes
     */
    Route::prefix('auth')->group(function() {
        Route::post('signin', [AuthController::class, 'signin'])->name('auth.signin');

        Route::middleware(['auth:sanctum'])->group(function() {
            Route::get('me', [AuthController::class, 'me'])->name('auth.me');
            Route::post('signout', [AuthController::class, 'signout'])->name('auth.signout');
            Route::get('my-sessions', [AuthController::class, 'mySessions'])->name('auth.my-sessions');
        });
    });

    /**
     * Admin routes
     */
    Route::prefix('admin')->group(function() {
        /**
         * User Sessions
         */
        Route::prefix('user-sessions')->group(function() {
            Route::get('/', [UserSessionsController::class, 'index'])->name('user-sessions.index');
            Route::get('/{userId}', [UserSessionsController::class, 'user'])->name('user-sessions.user');
        });

        /**
         * Users & User Roles
         */
        Route::apiResource('users', UsersController::class);
        Route::apiResource('user-roles', UserRolesController::class);
        Route::post('/user-roles/assign-role-to-user', [UserRolesController::class, 'assignRoleToUser'])->name('user-roles.assign-role-to-user');

        /**
         * Staffs
         */
        Route::apiResource('staffs', StaffsController::class);
    });

    Route::prefix('dashboard-statistics')->group(function() {
        Route::get('/', [DashboardStatisticsController::class, 'getOverallStatistics'])->name('dashboard-statistics.overall');
    });

    Route::apiResource('patient-hmo-providers', PatientHmoProvidersController::class);
    Route::get('patient-hmo-providers/slug/{nameSlug}', [PatientHmoProvidersController::class, 'showByNameSlug'])->name('patient-hmo-providers.show-by-name-slug');


    Route::apiResource('patient-profiles', PatientProfilesController::class);
    Route::apiResource('patient-hmos', PatientHmosController::class);
});
