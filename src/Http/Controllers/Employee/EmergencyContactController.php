<?php

namespace HRis\PIM\Http\Controllers\Employee;

use HRis\PIM\Eloquent\Employee;
use Illuminate\Http\JsonResponse;
use HRis\PIM\Eloquent\EmergencyContact;
use HRis\PIM\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use HRis\PIM\Http\Resources\EmergencyContact as Resource;
use HRis\PIM\Http\Requests\EmergencyContactRequest as Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmergencyContactController extends Controller
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
        return Resource::collection($employee->emergencyContacts);
    }

    /**
     * Display the specified resource.
     *
     * @param Request           $request
     * @param Employee          $employee
     * @param EmergencyContact  $emergencyContact
     *
     * @return Resource
     */
    public function show(Request $request, Employee $employee, EmergencyContact $emergencyContact): Resource
    {
        return new Resource($emergencyContact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request   $request
     * @param Employee  $employee
     *
     * @return Resource
     */
    public function store(Request $request, Employee $employee): Resource
    {
        $data = array_merge($request->all(), ['user_id' => $request->user()->id]);

        $emergencyContact = EmergencyContact::create($data);

        $employee->emergencyContacts()->save($emergencyContact);
        
        return new Resource($emergencyContact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request           $request
     * @param Employee          $employee
     * @param EmergencyContact  $emergencyContact
     *
     * @return Resource
     */
    public function update(Request $request, Employee $employee, EmergencyContact $emergencyContact): Resource
    {
        $data = $request->all();

        $emergencyContact = tap($emergencyContact)->update($data);

        return new Resource($emergencyContact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request           $request
     * @param Employee          $employee
     * @param EmergencyContact  $emergencyContact
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Employee $employee, EmergencyContact $emergencyContact): JsonResponse
    {
        $emergencyContact->delete();

        return response()->json(['status' => trans('core::app.delete_resource_successful')], Response::HTTP_OK);
    }
}
