<?php

namespace App\Http\Resources\PMO;

use Illuminate\Http\Resources\Json\JsonResource;

class PoItem extends JsonResource
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
            "po_id" => $this->po_no,
            "item_id" => $this->item_code !== "" ? $this->item_code : null,
            "item_desc" => $this->item_desc,
            "item_unit" => $this->item_unit,
            "quantity" => $this->item_qty,
            "cost" => (float)$this->item_cost,
            "brand" => $this->brand !== "" ? $this->brand : null,
            "total_cost" => $this->item_cost * $this->item_qty,
            "total_received" => $this->total_received > 0 ? $this->total_received : "",
        ];
    }
}
