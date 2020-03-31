<?php

namespace HRis\PIM\Http\Controllers\Employee;

use HRis\PIM\Eloquent\Job;
use HRis\PIM\Eloquent\Employee;
use Illuminate\Http\JsonResponse;
use HRis\PIM\Http\Controllers\Controller;
use HRis\PIM\Http\Resources\Job as Resource;
use Symfony\Component\HttpFoundation\Response;
use HRis\PIM\Http\Requests\JobRequest as Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class JobController extends Controller
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
        return Resource::collection($employee->jobs->sortByDesc('effective_at'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request  $request
     * @param Employee $employee
     * @param Job      $job
     *
     * @return Resource
     */
    public function show(Request $request, Employee $employee, Job $job): Resource
    {
        return new Resource($job);
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

        $job = Job::create($data);

        $employee->jobs()->save($job);
        
        return new Resource($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Employee $employee
     * @param Job      $job
     *
     * @return Resource
     */
    public function update(Request $request, Employee $employee, Job $job): Resource
    {
        $data = $request->all();

        $job = tap($job)->update($data);

        return new Resource($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request  $request
     * @param Employee $employee
     * @param Job      $job
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Employee $employee, Job $job): JsonResponse
    {
        $job->delete();

        return response()->json(['status' => trans('core::app.delete_resource_successful')], Response::HTTP_OK);
    }
}
