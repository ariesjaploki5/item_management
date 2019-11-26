<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Item extends JsonResource
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
            'category_desc' => $this->category->category_desc,
            'item_desc' => $this->item_desc,
            'unit_desc' => $this->unit_desc,

        ];  
    }
}
