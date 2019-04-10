<?php

namespace App;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Employee'
 *
 * @property string $email
 * @property string $fio
 * @property string $pin
 * @property string $phone
 * @property string $address
 * @property int    $status
 * @property int    department_id
 * @property-read  Department $department
 */
class Employee extends Model
{
    const ASSIGNED = 1;
    const RELEASED = 0;

    private static $statuses = [
        self::RELEASED => 'Освобожден',
        self::ASSIGNED => 'Назначен',
    ];

    private $filters = [];

    protected $fillable = [
        'email',
        'fio',
        'pin',
        'phone',
        'address',
        'status',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public static function getStatus(int $key)
    {
        return self::$statuses[$key];
    }
}
