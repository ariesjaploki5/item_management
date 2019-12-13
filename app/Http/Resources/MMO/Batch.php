<?php

namespace App\Http\Resources\MMO;

use Illuminate\Http\Resources\Json\JsonResource;

class Batch extends JsonResource
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
            'iar_no' => $this->iar_no, 
            'batch_no' => $this->batch_no, 
            'item_id' => $this->item_id, 
            // 'item_desc' => $this->item->item_desc,
            'item_desc' => $this->item_desc,
            // 'item_unit' => $this->item_unit,
            // 'brand_id' => $this->brand_id,
            // 'brand_desc' => $this->brand->brand_desc,
            'brand_desc' => $this->brand,
            'quantity' => (float)$this->quantity,
            'cost' => (float)$this->cost,
            'total_cost' => (float)$this->cost * $this->quantity,
            'expiration_date' => $this->expiration_date, 
            // 'remarks' => $this->remarks,
            // 'total_cost' => ($this->cost * $this->quantity),
            'total_issued' => $this->total_issued,
            'remaining_quantity' => ($this->quantity - $this->total_issued)
        ];
    }
}
