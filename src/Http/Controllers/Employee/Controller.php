<?php

namespace HRis\PIM\Http\Controllers\Employee;

use HRis\PIM\Eloquent\Employee;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use HRis\PIM\Http\Resources\Employee as Resource;
use HRis\PIM\Http\Requests\EmployeeRequest as Request;
use HRis\PIM\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $query = Employee::processQuery($request);

        $result = $this->perPage === 'all' ? $query->get() : $query->paginate($this->perPage);

        if ($groupBy = $request->query('groupBy')) {
            $data = [];
            foreach ($result as $item) {
                $column = $item->$groupBy;

                $initial = strtoupper(substr($column, 0, 1));

                $data[$initial][] = new Resource($item);
            }

            $paginated = $result->toArray();

            $response = array_merge_recursive(['data' => $data], $this->paginationInformation($paginated));

            return response()->json($response);
        }

        return Resource::collection($result);
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
        $employee = Employee::transactionSafeCreate($request->all() + ['user_id' => $request->user()->id]);

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
