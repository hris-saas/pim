<?php

namespace HRServices\PIM\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use HRServices\PIM\Http\Resources\EmployeeField as Resource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use HRServices\PIM\Http\Requests\EmployeeFieldRequest as Request;

class EmployeeFieldController extends Controller
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
        $collection = (new $request->model_type)::orderBy('sort_order')->paginate($this->perPage);

        return Resource::collection($collection);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Resource
     */
    public function show(Request $request): Resource
    {
        $record = (new $request->model_type)::findOrFail($request->model_id);

        return new Resource($record);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \HRServices\PIM\Http\Resources\EmployeeField
     */
    public function store(Request $request): Resource
    {
        $data = $request->getData();

        $record = (new $request->model_type)::create($data);
        
        return new Resource($record);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return \HRServices\PIM\Http\Resources\EmployeeField
     */
    public function update(Request $request): Resource
    {
        $data = $request->getData();

        $record = (new $request->model_type)::findOrFail($request->model_id);

        $record = tap($record)->update($data);

        return new Resource($record);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $record = (new $request->model_type)::findOrFail($request->model_id);

        $record->delete();

        return response()->json(['status' => trans('core::app.delete_resource_successful')], Response::HTTP_OK);
    }
}
