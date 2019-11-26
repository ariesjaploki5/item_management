<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PurchaseRequestDetail as PurchaseRequestDetailResource;

class PurchaseRequest extends JsonResource
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
            'pr_no' => $this->pr_no,
            'pr_date' => $this->created_at->format('Y-m-d'),
            'requested_by' => $this->user->user_first. ' '. $this->user->user_last,
            'category_id' => $this->category_id,
            'category_desc' => $this->category->category_desc,
            'purpose' => $this->purpose,
            'items' => PurchaseRequestDetailResource::collection($this->details),
        ];
    }
}
