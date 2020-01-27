<?php

namespace App\Http\Resources\MMO;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MMO\BatchRis as BatchRisResource;

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
            'issued_name' => $this->issued_name !== null ? $this->issued_name : null,
            'issued_date' => $this->issued_date !== null ? $this->issued_date->format('d-m-Y') : null,
            'requested_name' => $this->requested_name !== null ? $this->requested_name : " ",
            'requested_date' => $this->requested_date !== null ? $this->requested_date->format('d-m-Y') : null,
            'approved_date' => $this->approved_date !== null ? $this->approved_date->format('d-m-Y') : null,
            'received_name' => $this->received_name !== null ? $this->received_name : null,
            'received_date' => $this->received_date !== null ? $this->received_date->format('d-m-Y') : null,
            'purpose' => $this->purpose,
            'department' => $this->department,
            'division' => $this->division,
            'items' => BatchRisResource::collection($this->batches),
            
        ];
    }
}
