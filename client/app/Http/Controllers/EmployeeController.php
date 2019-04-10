<?php

namespace App\Http\Controllers;

use App\Services\StorageInterface;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class EmployeeController extends Controller
{
    const ASSIGNED = 1;
    const RELEASED = 0;

    /** Список статусов должен быть описан в документации */
    private $statuses = [
        self::RELEASED => 'Освобожден',
        self::ASSIGNED => 'Назначен',
    ];

    private $client;

    public function __construct(StorageInterface $client)
    {
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $departments       = $this->client->getDepartments();
        $departmentsSelect = $this->getSelect($departments);
        $departmentId      = $request->get('department_id') ?? 0;
        $employees         = $this->client->getEmployees($departmentId);

        return view('employee.index', [
            'departmentsSelect' => $departmentsSelect,
            'departmentId'      => $departmentId,
            'employees'         => $employees,
        ]);
    }

    public function create()
    {
        $departments       = $this->client->getDepartments();
        $departmentsSelect = $this->getSelect($departments, false);

        return view('employee.create', [
            'departmentsSelect' => $departmentsSelect,
            'statuses'          => $this->statuses
        ]);
    }

    public function store(Request $request)
    {
        try {
            $result = $this->client->createEmployee($request->all());
        } catch (ClientException $e) {
            abort($e->getCode());
        }

        if (isset($result['errors'])) {
            $errorsBag = new MessageBag($result['errors']);

            return redirect()->back()->withInput($request->all())->withErrors($errorsBag);
        }

        return redirect()->route('employees.show', $result);
    }

    public function show(int $id)
    {
        try {
            $employee = $this->client->getEmployee($id);
        } catch (ClientException $e) {
            abort($e->getCode());
        }

        $departments = $this->client->getDepartment($employee->department_id);

        return view('employee.show', [
            'employee'        => $employee,
            'departmentTitle' => $departments->title,
            'statuses'        => $this->statuses
        ]);
    }

    public function edit(int $id)
    {
        try {
            $employee = $this->client->getEmployee($id);
        } catch (ClientException $e) {
            abort($e->getCode());
        }

        $departments       = $this->client->getDepartments();
        $departmentsSelect = $this->getSelect($departments);

        return view('employee.edit', [
            'employee'          => $employee,
            'departmentsSelect' => $departmentsSelect,
            'statuses'          => $this->statuses
        ]);
    }

    public function update(Request $request, int $id)
    {
        try {
            $entity = $this->client->updateEmployee($id, $request->all());
        } catch (ClientException $e) {
            abort($e->getCode());
        }

        return redirect()->route('employees.show', $entity->id);
    }

    public function destroy(int $id)
    {
        try {
            $this->client->destroyEmployee($id);
        } catch (ClientException $e) {
            abort($e->getCode());
        }

        return redirect()->route('employees.index');
    }

    /* TODO: Это по идее надо вынести отсюда */
    private function getSelect(array $departments, bool $all = true)
    {
        $departmentsSelect = $all ? ['Все отделы'] : [];

        array_map(function ($item) use (&$departmentsSelect) {
            $departmentsSelect[$item->id] = $item->title;
        }, $departments);

        return $departmentsSelect;
    }
}
