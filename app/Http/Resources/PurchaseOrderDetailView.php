<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderDetailView extends JsonResource
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
            'pod_id' => $this->pod_id,
            'po_no' => $this->po_no,
            'item_id' => $this->item_id,
            'item_desc' => $this->item_desc,
            'brand_id' => $this->brand_id,
            'brand_desc' => $this->brand_desc,
            'packaging_id' => $this->packaging_id,
            'packaging_desc' => $this->packaging_desc,
            'country_id' => $this->country_id,
            'country_desc' => $this->country_desc,
            'manufacturer_id' => $this->manufacturer_id,
            'manufacturer_desc' => $this->manufacturer_desc,
            'cost' =>  number_format($this->cost,4),
            'quantity' => $this->total_quantity,
            'total_received' => $this->total_received > 0 ? $this->total_received : 0,
            'pending_quantity' => $this->pending_quantity,
            'total_cost' => number_format(round(($this->cost * $this->total_quantity), 4),4),
        ];
    }
}
