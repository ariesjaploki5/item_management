<?php

namespace App\Http\Resources\MMO;

use Illuminate\Http\Resources\Json\JsonResource;

class Dv extends JsonResource
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
            'dv_no' => $this->dv_no,
            'po_no' => $this->po_no,
            'approving_officer_name' => $this->approving_officer->name,
            'dv_date' => $this->created_at->format('d-m-Y'),
            
        ];
    }
}
