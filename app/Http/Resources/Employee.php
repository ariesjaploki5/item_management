<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
{

    public function toArray($request)
    {
        
        return [
            'employee_id' => $this->employee_id,
            'employee_name' => $this->employee_name,
            'department_desc' => $this->department->department_desc,
            'department_id' => $this->department_id,
            'division_id' => $this->department->division_id,
            'division_desc' => $this->department->division->division_desc,
        ];
    }
}
