<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'role_id' => $this->role_id,
            'employee_id' => $this->employee_id,
            'employee_name' => $this->employee->employee_name,
            'department' => $this->employee->department->department_desc,
            'department_id' => $this->employee->department_id,
            'division' => $this->employee->department->division->division_desc,
            'division_id' => $this->employee->department->division_id,
        ];
    }
}
