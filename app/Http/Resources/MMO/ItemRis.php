<?php

namespace App\Http\Resources\MMO;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MMO\ItemRisIssuance as ItemRisIssuanceResource;

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
            'item_ris_id' => $this->item_ris_id,
            'item_id' => $this->item_id,
            'item_desc' => $this->item->item_desc,
            'unit_desc' => $this->item->unit_desc,
            'ris_no' => $this->ris_no,
            'requested_quantity' => $this->requested_quantity,
            'issued_quantity' => $this->issued_quantity,
            'batch_no' => $this->batch_no,
            'issuances' => ItemRisIssuanceResource::collection($this->item_ris_issuances),
        ];
    }
}
