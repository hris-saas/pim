<?php

namespace HRis\PIM\Http\Controllers\Employee;

use HRis\PIM\Eloquent\Employee;
use Illuminate\Http\JsonResponse;
use HRis\PIM\Eloquent\Compensation;
use HRis\PIM\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use HRis\PIM\Http\Resources\Compensation as Resource;
use HRis\PIM\Http\Requests\CompensationRequest as Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompensationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request   $request
     * @param Employee  $employee
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, Employee $employee): AnonymousResourceCollection
    {
        return Resource::collection($employee->compensation);
    }

    /**
     * Display the specified resource.
     *
     * @param Request       $request
     * @param Employee      $employee
     * @param Compensation  $compensation
     *
     * @return Resource
     */
    public function show(Request $request, Employee $employee, Compensation $compensation): Resource
    {
        return new Resource($compensation);
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

        $compensation = Compensation::create($data);

        $employee->compensation()->save($compensation);

        return new Resource($compensation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request       $request
     * @param Employee      $employee
     * @param Compensation  $compensation
     *
     * @return Resource
     */
    public function update(Request $request, Employee $employee, Compensation $compensation): Resource
    {
        $data = $request->all();

        $compensation = tap($compensation)->update($data);

        return new Resource($compensation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request       $request
     * @param Employee      $employee
     * @param Compensation  $compensation
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Employee $employee, Compensation $compensation): JsonResponse
    {
        $compensation->delete();

        return response()->json(['status' => trans('core::app.delete_resource_successful')], Response::HTTP_OK);
    }
}
