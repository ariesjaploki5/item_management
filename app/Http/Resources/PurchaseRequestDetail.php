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
            'total_cost' => (float)$this->cost * $this->quantity,
            'brand_desc' => $this->brand_desc,
            'country_desc' => $this->country_desc,
            'manufacturer_desc' => $this->manufacturer_desc,
            'packaging_desc' => $this->packaging_desc,
            'offer' => $this->offer,
            'other_details' => $this->other_details,
         ];
    }
}
