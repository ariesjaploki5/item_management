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
            'item_desc' => $this->batch->item_desc,
            'brand' => $this->batch->brand,
            'item_unit' => $this->batch->item_unit !== null ? $this->batch->item_unit : null,
            'requested_quantity' => (float)$this->requested_quantity,
            'issued_quantity' => (float)$this->issued_quantity,
            'expiration_date' => $this->batch->expiration_date,
            'cost' => (float)$this->batch->cost,
        ];
    }
}
