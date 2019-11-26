<?php

namespace App\Http\Resources\MMO;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemRisIssuance extends JsonResource
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
            'id' => $this->id,
            'item_ris_id' => $this->item_ris_id,
            'issued_quantity' => $this->issued_quantity,
            'batch_no' => $this->batch_no,
            'cost' => "₱ ".(float)$this->batch->cost,
        ];
    }
}
