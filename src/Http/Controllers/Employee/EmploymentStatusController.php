<?php

namespace HRis\PIM\Http\Controllers\Employee;

use HRis\PIM\Eloquent\Employee;
use Illuminate\Http\JsonResponse;
use HRis\PIM\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use HRis\PIM\Http\Resources\EmployeeEmploymentStatus as Resource;
use HRis\PIM\Eloquent\EmployeeEmploymentStatus as EmploymentStatus;
use HRis\PIM\Http\Requests\EmployeeEmploymentStatusRequest as Request;

class EmploymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request  $request
     * @param Employee $employee
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, Employee $employee): AnonymousResourceCollection
    {
        return Resource::collection($employee->employmentStatuses->sortByDesc('effective_at'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request           $request
     * @param Employee          $employee
     * @param EmploymentStatus  $employmentStatus
     *
     * @return Resource
     */
    public function show(Request $request, Employee $employee, EmploymentStatus $employmentStatus): Resource
    {
        return new Resource($employmentStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request  $request
     * @param Employee $employee
     *
     * @return Resource
     */
    public function store(Request $request, Employee $employee): Resource
    {
        $data = array_merge($request->all(), ['user_id' => $request->user()->id]);

        $employmentStatus = EmploymentStatus::create($data);

        $employee->employmentStatuses()->save($employmentStatus);
        
        return new Resource($employmentStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request           $request
     * @param Employee          $employee
     * @param EmploymentStatus  $employmentStatus
     *
     * @return Resource
     */
    public function update(Request $request, Employee $employee, EmploymentStatus $employmentStatus): Resource
    {
        $data = $request->all();

        $employmentStatus = tap($employmentStatus)->update($data);

        return new Resource($employmentStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request           $request
     * @param Employee          $employee
     * @param EmploymentStatus  $employmentStatus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Employee $employee, EmploymentStatus $employmentStatus): JsonResponse
    {
        $employmentStatus->delete();

        return response()->json(['status' => trans('core::app.delete_resource_successful')], Response::HTTP_OK);
    }
}
