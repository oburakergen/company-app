<?php

namespace App\Repositories;

use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use App\Models\Company;
use App\Repositories\Interfaces\CompanyInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyRepository implements CompanyInterface
{

    /**
     * @param array $credentials
     * @return JsonResponse
     */
    public function create(array $credentials): JsonResponse
    {

        try {
            $imageName = time().'.'.$credentials['logo']->extension();
            $credentials['logo']->move(public_path('images'), $imageName);

            Company::create([
                ...$credentials,
                'logo' => (config('APP_URL') . '/images/' . $imageName)
            ]);
            $company = Company::all();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new CompanyCollection($company), 201);
    }

    /**
     * @param array $credentials
     * @param int $companyId
     * @return JsonResponse
     */
    public function update(int $companyId, array $credentials): JsonResponse
    {
        try {
            if (gettype($credentials['logo']) === 'object') {
                $imageName = time().'.'.$credentials['logo']->extension();
                $credentials['logo']->move(public_path('images'), $imageName);
                $credentials['logo'] = (config('APP_URL') . '/images/' . $imageName);
            }

           Company::where('id', $companyId)->update($credentials);
           $company = Company::all();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new CompanyCollection($company), 200);
    }

    /**
     * @param int $companyId
     * @return JsonResponse
     */
    public function delete(int $companyId): JsonResponse
    {
        try {
            Employee::where('company_id', $companyId)->delete();
            Company::where('id', $companyId)->delete();
            $company = Company::all();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new CompanyCollection($company), 204);
    }

    /**
     * @param int $companyId
     * @return JsonResponse
     */
    public function show(int $companyId): JsonResponse
    {
        try {
            $company = Company::where('id', $companyId)->firstOrFail();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new CompanyResource($company), 200);
    }

    /**
     * @param int $companyId
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $company = Company::all();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new CompanyCollection($company), 200);
    }
}
