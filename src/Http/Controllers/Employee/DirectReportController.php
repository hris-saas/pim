<?php

namespace HRis\PIM\Http\Controllers\Employee;

use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Http\Controllers\Controller;
use HRis\PIM\Http\Resources\Employee as Resource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DirectReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Employee $employee): AnonymousResourceCollection
    {
        return Resource::collection($employee->directReports()->paginate($this->perPage));
    }
}
