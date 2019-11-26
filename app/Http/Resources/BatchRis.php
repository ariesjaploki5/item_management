<?php

namespace App\Http\Resources;

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
            'batch_no' => $this->batch_no,
            'item_desc' => $this->batch->item->item_desc,
            'brand_desc' => $this->batch->brand->brand_desc,
            'brand_id' => $this->batch->brand_id,
            'unit_desc' => $this->batch->item->unit_desc,
            'requested_quantity' => $this->requested_quantity,
            'issued_quantity' => $this->issued_quantity,
            'cost' => $this->batch->cost,
            'accepted' => $this->accepted,
            ''
        ];
    }
}
