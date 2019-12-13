<?php

namespace App\Http\Resources\MMO;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MMO\Batch as BatchResource;
use App\Http\Resources\PMO\Po as PoResource;

class Iar extends JsonResource
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
            'iar_no' => $this->iar_no,
            'iar_date' => $this->created_at->format('Y-m-d'),
            'inspection_date' => $this->inspection_date,
            'inspection_officer_id' => $this->inspection_officer_id,
            'inspection_officer_name' => $this->inspection_officer->name,
            'receiving_officer_id' => $this->receiving_officer_id,
            'receiving_officer_name' => $this->receiving_officer_id !== null ? $this->receiving_officer->name : null,
            'po_no' => $this->po_no,
            'po_date' => $this->pmo_po,
            'supplier_name' => $this->pmo_po,
            'received_date' => $this->received_date,
            'ref_no' => $this->ref_no,
            'ref_date' => $this->ref_date,
            'iar_total_amount' => $this->iar_total_amount,
            'batches' => BatchResource::collection($this->batches),
            'po' => new PoResource($this->po),
        ];
    }
}
