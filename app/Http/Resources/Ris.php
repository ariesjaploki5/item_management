<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BatchRis as BatchRisResource;
use App\Http\Resources\ItemRis as ItemRisResource;

class Ris extends JsonResource
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
            'control_no' => $this->control_no,
            'ris_no' => $this->ris_no,
            'ris_date' => $this->ris_date->format('d-m-Y'),
            
            'requested_by_user' => $this->requested_by !== null ? $this->requested_by_user->employee->employee_name: null,
            'requested_date' => $this->requested_date !== null ? $this->requested_date->format('d-m-Y') : null,
            'approved_by_user' => $this->approved_by_user !== null ? $this->approved_by->user_last.', '.$this->approved_by->user_first.' '.$this->approved_by->user_middle : " ",
            'approved_date' => $this->approved_date !== null ? $this->approved_date->format('d-m-Y') : null,
            'issued_by_user' => $this->issued_by_user !== null ? $this->issued_by->employee->employee_name : " ",
            'issued_date' => $this->issued_date !== null ? $this->issued_date->format('d-m-Y') : null,
            'approved_date' => $this->approved_date !== null ? $this->approved_date->format('d-m-Y') : null,
            'received_by_user' => $this->received_by_user !== null ? $this->received_by->employee->employee_name : " ",
            'received_date' => $this->received_date !== null ? $this->received_date->format('d-m-Y') : null,
            'purpose' => $this->purpose,
            'batches' => BatchRisResource::collection($this->batches),
            'items' => ItemRisResource::collection($this->item_ris),
            'category_id'=> $this->category_id,
            'category_desc' => $this->category->category_desc,
            'department_desc' => $this->requested_by !== null ? $this->requested_by_user->employee->department->department_desc: null,
            'division_desc' => $this->requested_by !== null ? $this->requested_by_user->employee->department->division->division_desc: null,
        ];
    }
}