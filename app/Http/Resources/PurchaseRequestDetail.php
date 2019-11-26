<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseRequestDetail extends JsonResource
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
            'item_id' => $this->item_id,
            'item_desc' => $this->item->item_desc,
            'cost' => (float)$this->cost,
            'quantity' => (float)$this->quantity,
            'remarks' => $this->remarks,
            'total_cost' => (float)$this->cost * $this->quantity
         ];
    }
}
