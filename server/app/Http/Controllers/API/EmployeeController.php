<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    private $model;

    private $rules = [
        'email' => 'required|email|max:255',
        'fio' => 'required|string|max:255',
        'pin' => 'required|string|max:255',
        'phone' => 'required|int',
        'address' => 'required|string|max:255',
        'status' => 'required|int|in:1,2',
        'department_id' => 'required|int',
    ];

    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departmentId = $request->get('department_id');
        if (!is_null($departmentId)) {
            $this->model = $this->model->where('department_id', $departmentId);
        }

        $employees = $this->model->get();

        return EmployeeResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return Employee|array
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            // тут нет точного кода поэтому используют по договоренности
            return response()->json(['errors' => $validator->errors()]);
        }

        $entity = Employee::create($request->all());

        return response($entity->id, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee $employee
     *
     * @return EmployeeResource
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Employee $employee
     *
     * @return EmployeeResource
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $employee->update($request->all());

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee $employee
     *
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
