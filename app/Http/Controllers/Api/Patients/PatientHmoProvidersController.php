<?php

namespace App\Http\Controllers\Api\Patients;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientsHmos\CreatePatientHmoProviderRequest;
use App\Http\Requests\PatientsHmos\UpdatePatientHmoProviderRequest;
use App\Services\PatientHmoProvidersService;
use App\Traits\ParamsHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PatientHmoProvidersController extends Controller
{
    use ParamsHelper;

    public function __construct(
        public readonly PatientHmoProvidersService $patientHmoProvidersService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $queryParams = $this->createPaginationParams($request->query());
        $result = $this->patientHmoProvidersService->getList($queryParams, $queryParams->paginated);


        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePatientHmoProviderRequest $request) : JsonResponse
    {
        $result = $this->patientHmoProvidersService->create($request->validated());

        return response()->json($result, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->patientHmoProvidersService->getById($id);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientHmoProviderRequest $request, string $id)
    {
        $result = $this->patientHmoProvidersService->updateById($id, $request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->patientHmoProvidersService->deleteById($id);

        return response()->json($result, Response::HTTP_NO_CONTENT);
    }

    /**
     * Display specified resource by slug name
     */
    public function showByNameSlug(string $nameSlug)
    {
        $result = $this->patientHmoProvidersService->getByNameSlug($nameSlug);

        return response()->json($result, Response::HTTP_OK);
    }
}
