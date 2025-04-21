<?php

namespace App\Http\Controllers\Api\Patients;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientsHmos\CreatePatientHmoRequest;
use App\Http\Requests\PatientsHmos\UpdatePatientHmoRequest;
use App\Services\PatientHmosService;
use App\Traits\ParamsHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PatientHmosController extends Controller
{
    use ParamsHelper;

    public function __construct(
        public readonly PatientHmosService $patientHmosService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $queryParams = $this->createPaginationParams($request->query());
        $result = $this->patientHmosService->getList($queryParams, $queryParams->paginated);


        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePatientHmoRequest $request) : JsonResponse
    {
        $result = $this->patientHmosService->create($request->validated());

        return response()->json($result, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->patientHmosService->getById($id);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientHmoRequest $request, string $id)
    {
        $result = $this->patientHmosService->updateById($id, $request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->patientHmosService->deleteById($id);

        return response()->json($result, Response::HTTP_NO_CONTENT);
    }
}
