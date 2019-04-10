<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'fio' => $this->fio,
            'pin' => $this->pin,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
            'department_id' => $this->department_id
        ];
    }
}
