<?php

namespace App\Http\Controllers;

use App\Services\StorageInterface;


class DepartmentController extends Controller
{
    private $client;

    public function __construct(StorageInterface $client)
    {
        $this->client = $client;
    }

    /* TODO: Это по идее надо вынести отсюда */
    private function getSelect(array $departments)
    {
        $departmentsSelect = [];

        array_map(function ($item) use (&$departmentsSelect) {
            $departmentsSelect[$item->id] = $item->title;
        }, $departments);

        return $departmentsSelect;
    }
}
