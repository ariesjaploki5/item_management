<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemRis extends JsonResource
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
            'control_no' => $this->control_no,
            'item_id' => $this->item_id,
            'item_desc' => $this->item->item_desc,
            'requested_quantity' => $this->requested_quantity !== null ? (float)$this->requested_quantity : null,
            'issued_quantity' => $this->issued_quantity !== null ? (float)$this->issued_quantity : null,
            'unit_desc' => $this->item->unit_desc,
        ];
    }
}
