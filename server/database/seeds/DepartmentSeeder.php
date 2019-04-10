<?php

use Illuminate\Database\Seeder;
use App\Department;
use App\Employee;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        factory(Department::class, 5)->create()->each(function (Department $department) {
            $rand = rand(1,15);
            for($i = 0; $i < $rand; $i++) {
                $department->employees()->save(factory(Employee::class)->make());
            }
        });
    }
}
