<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderDetail extends JsonResource
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
            'po_no' => $this->po_no,
            'item_id' => $this->item_id,
            'item_desc' => $this->item->item_desc,
            'brand_id' => $this->brand_id,
            'brand_desc' => $this->brand->brand_desc,
            'packaging_id' => $this->packaging_id,
            'packaging_desc' => $this->packaging->packaging_desc,
            'country_id' => $this->country_id,
            'country_desc' => $this->country->country_desc,
            'manufacturer_id' => $this->manufacturer_id,
            'manufacturer_desc' => $this->manufacturer->manufacturer_desc,
            'cost' => (float)$this->cost,
            'quantity' => (float)$this->quantity,
            'total_cost' => round(($this->cost * $this->quantity), 2),
        ];
    }
}
