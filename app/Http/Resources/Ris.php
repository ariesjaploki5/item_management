<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BatchRis as BatchRisResource;

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
            'issued_date' => $this->issued_date !== null ? $this->issued_date->format('d-m-Y') : null,
            // 'requested_by' => $this->requested_by !== null ? $this->requested_by->user_last.', '.$this->requested_by->user_first.' '.$this->requested_by->user_middle : " ",
            'requested_date' => $this->requested_date !== null ? $this->requested_date->format('d-m-Y') : null,
            // 'approved_by' => $this->approved_by !== null ? $this->approved_by->user_last.', '.$this->approved_by->user_first.' '.$this->approved_by->user_middle : " ",
            'approved_date' => $this->approved_date !== null ? $this->approved_date->format('d-m-Y') : null,
            // 'issued_by' => $this->issued_by !== null ? $this->issued_by->user_last.', '.$this->issued_by->user_first.' '.$this->issued_by->user_middle : " ",
            'approved_date' => $this->approved_date !== null ? $this->approved_date->format('d-m-Y') : null,
            // 'received_by' => $this->received_by !== null ? $this->received_by->user_last.', '.$this->received_by->user_first.' '.$this->received_by->user_middle : " ",
            'received_date' => $this->received_date !== null ? $this->received_date->format('d-m-Y') : null,
            'purpose' => $this->purpose,
            'batches' => BatchRisResource::collection($this->batches),
        ];
    }
}