<?php

namespace App\Repositories;

use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class EmployeeRepository implements EmployeeInterface
{
    public function create(array $credentials): JsonResponse
    {
        try {
            Employee::create([
                ...$credentials
            ]);
            $employee = Employee::all();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new EmployeeCollection($employee), 201);
    }

    public function update(int $employeeId, array $credentials): JsonResponse
    {
        try {
            Employee::where('id', $employeeId)->update($credentials);
            $employee = Employee::all();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new EmployeeCollection($employee), 200);
    }

    public function delete(int $employeeId): JsonResponse
    {
        try {
            $employee = Employee::findById($employeeId);
            dd($employee);
            Employee::where('id', $employeeId)->delete();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new EmployeeCollection($employee), 200);
    }

    public function show(int $employeeId): JsonResponse
    {
        try {
            $employee = Employee::where('id', $employeeId)->get();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->error(['errors' => $exception->getMessage()], 404));
        }

        return response()->success(new EmployeeResource($employee), 200);
    }
}
