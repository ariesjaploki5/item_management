<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BatchView as BatchViewResource;

class ItemView extends JsonResource
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
            'item_desc' => $this->item_desc,
            'unit_desc' => $this->unit_desc,
            'category_desc' => $this->category_desc,
            'homis_stock' => $this->homis_stock > 0 ? $this->homis_stock : 0,
            'mmo_stock' => $this->mmo_stock > 0 ? $this->mmo_stock : 0,
            'batches' => BatchViewResource::collection($this->batches),
        ];
    }
}
