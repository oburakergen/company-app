<?php

namespace App\Repositories;

use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Repositories\Interfaces\CompanyInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyRepository implements CompanyInterface
{

    /**
     * @param array $credentials
     * @return CompanyCollection
     * @throws HttpResponseException
     */
    public function create(array $credentials): CompanyCollection
    {
        try {
            $company = Company::create([
                ...$credentials
            ]);
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return new CompanyCollection($company);
    }

    public function update(int $companyId, array $credentials): CompanyCollection
    {
        try {
            $company = Company::where('id', $companyId)->update($credentials);
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return new CompanyCollection($company);
    }

    public function delete(int $companyId): CompanyCollection
    {
        try {
            $company = Company::where('id', $companyId)->delete();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return new CompanyCollection($company);
    }

    public function show(int $companyId): CompanyResource
    {
        try {
            $company = Company::where('id', $companyId)->firstOrFail();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return new CompanyResource($company);
    }
}
