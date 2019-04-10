<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.04.2019
 * Time: 21:57
 */

namespace App\Services;


interface StorageInterface
{
    public function getDepartments();
    public function getDepartment(int $id);

    public function getEmployees(int $departmentId);
    public function getEmployee(int $id);
    public function createEmployee(array $data);
    public function updateEmployee(int $id, array $data);
    public function destroyEmployee(int $id);
}