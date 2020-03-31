<?php

namespace HRis\PIM\Http\Controllers\Employee;

use HRis\PIM\Eloquent\Address;
use HRis\PIM\Eloquent\Employee;
use Illuminate\Http\JsonResponse;
use HRis\PIM\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use HRis\PIM\Http\Resources\Address as Resource;
use HRis\PIM\Http\Requests\AddressRequest as Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AddressController extends Controller
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
        return Resource::collection($employee->addresses);
    }

    /**
     * Display the specified resource.
     *
     * @param Request  $request
     * @param Employee $employee
     * @param Address  $address
     *
     * @return Resource
     */
    public function show(Request $request, Employee $employee, Address $address): Resource
    {
        return new Resource($address);
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
        $data = $request->all();

        $address = Address::create($data);

        $employee->addresses()->save($address);
        
        return new Resource($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Employee $employee
     * @param Address  $address
     *
     * @return Resource
     */
    public function update(Request $request, Employee $employee, Address $address): Resource
    {
        $data = $request->all();

        $address = tap($address)->update($data);

        return new Resource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request  $request
     * @param Employee $employee
     * @param Address  $address
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Employee $employee, Address $address): JsonResponse
    {
        $address->delete();

        return response()->json(['status' => trans('core::app.delete_resource_successful')], Response::HTTP_OK);
    }
}
