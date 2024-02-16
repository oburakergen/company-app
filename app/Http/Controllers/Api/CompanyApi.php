<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Repositories\CompanyRepository;
use Illuminate\Http\JsonResponse;

class CompanyApi extends Controller
{
    public function __construct(protected CompanyRepository $companyRepository){}
    /**
     * Store a newly created resource in storage.
     */
    public function index(): JsonResponse
    {
        return $this->companyRepository->index();
    }
    public function store(CompanyRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        return $this->companyRepository->create($credentials);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->companyRepository->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, int $id): JsonResponse
    {
        $credentials = $request->validated();

        return $this->companyRepository->update($id, $credentials);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->companyRepository->delete($id);
    }
}
