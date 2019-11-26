<?php

namespace App\Http\Resources\MMO;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MMO\Batch as BatchResource;
use App\Http\Resources\MMO\Po as PoResource;

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
            'iar_no' => $this->iar_no !== null ? $this->iar_no : "" ,
            'iar_date' => "(".($this->created_at->format('l')).") ".$this->created_at->format('d-m-Y') . " / " .$this->created_at->format('h:i A'),
            'resp_center' => $this->po->dept_name !== null ? $this->po : "",
            'po_no' => $this->po_no !== null ? $this->po_no : "",
            'pr_no' => $this->po->pr_no !== null ? $this->po->pr_no : "",
            'received_date' => "(".($this->received_date->format('l')).") ".$this->received_date->format('d-m-Y'),
            'supplier_name' => $this->po->supplier !== null ? $this->po->supplier : "",
            'po_date' => $this->po->po_date->format('d-m-Y'),
            'ref_no' => $this->ref_no  !== null ? $this->ref_no : "",
            'ref_date' => $this->ref_date !== null ? $this->ref_date : "",
            'inspection_date' => $this->insection_date !== null ? $this->insection_date : "",
            'inspector' => $this->inspection_officer_id !== null ? $this->inspection_officer->name : "",
            'batches' =>  BatchResource::collection($this->batches)
        ];
    }
}
