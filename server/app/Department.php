<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * An Eloquent Model: 'Department'
 *
 * @property string $title
 * @property-read  Collection|Employee[] $employee
*/
class Department extends Model
{
    protected $fillable = ['title'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
