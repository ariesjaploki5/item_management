<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchView extends JsonResource
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
            'batch_no' => $this->batch_no,
            'cost' => $this->cost,
            'expiration_date' => $this->expiration_date,
            'item_id' => $this->item_id,
            'item_desc' => $this->item_desc,
            'unit_desc' => $this->unit_desc,
            'brand_id' => $this->brand_id,
            'brand_desc' => $this->brand_desc,
            'total_quantity' => $this->total_quantity,
            'remaining_quantity' => $this->remaining_quantity,
            'total_issued' => $this->total_issued,
        ];
    }
}
