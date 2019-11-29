<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Obrs extends JsonResource
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
            'obrs_no' => $this->obrs_no,
            'fund_cluster_id' => $this->fund_cluster_id,
        ];
    }
}
