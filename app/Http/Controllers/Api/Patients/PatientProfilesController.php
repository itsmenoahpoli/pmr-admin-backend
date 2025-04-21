<?php

namespace App\Http\Controllers\Api\Patients;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientProfiles\CreatePatientProfileRequest;
use App\Http\Requests\PatientProfiles\UpdatePatientProfileRequest;
use App\Services\PatientProfilesService;
use App\Traits\ParamsHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PatientProfilesController extends Controller
{
    use ParamsHelper;

    public function __construct(
        public readonly PatientProfilesService $patientProfilesService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $queryParams = $this->createPaginationParams($request->query());
        $result = $this->patientProfilesService->getList($queryParams, $queryParams->paginated);


        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePatientProfileRequest $request) : JsonResponse
    {
        $result = $this->patientProfilesService->create($request->validated());

        return response()->json($result, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->patientProfilesService->getById($id);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientProfileRequest $request, string $id)
    {
        $result = $this->patientProfilesService->updateById($id, $request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->patientProfilesService->deleteById($id);

        return response()->json($result, Response::HTTP_NO_CONTENT);
    }
}
