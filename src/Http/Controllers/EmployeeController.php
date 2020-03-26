<?php

namespace HRis\PIM\Http\Controllers;

use HRis\PIM\Eloquent\Employee;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use HRis\PIM\Http\Resources\Employee as Resource;
use HRis\PIM\Http\Requests\EmployeeRequest as Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $employees = Employee::paginate($this->perPage);

        return Resource::collection($employees);
    }

    /**
     * Display the specified resource.
     *
     * @param Request  $request
     * @param Employee $employee
     *
     * @return Resource
     */
    public function show(Request $request, Employee $employee): Resource
    {
        return new Resource($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Resource
     */
    public function store(Request $request): Resource
    {
        $data = $request->all();

        $employee = Employee::create($data);
        
        return new Resource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Employee $employee
     *
     * @return Resource
     */
    public function update(Request $request, Employee $employee): Resource
    {
        $data = $request->all();

        $employee = tap($employee)->update($data);

        return new Resource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request  $request
     * @param Employee $employee
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Employee $employee): JsonResponse
    {
        $employee->delete();

        return response()->json(['status' => trans('core::app.delete_resource_successful')], Response::HTTP_OK);
    }
}
