<?php

namespace App\Http\Resources\MMO;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchRis extends JsonResource
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
            'batch_ris_id' => $this->batch_ris_id,
            'control_no' => $this->control_no,
            'batch_no' => $this->batch_no,
            'requested_quantity' => $this->requested_quantity,
            'issued_quantity' => $this->issued_quantity,
        ];
    }
}
