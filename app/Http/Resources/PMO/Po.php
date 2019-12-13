<?php

namespace App\Http\Resources\PMO;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PMO\PoItem as PoItemResource;
use App\Http\Resources\MMO\Iar as IarResource;
class Po extends JsonResource
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
            'po_no' => $this->po_no,
            'pr_no' => $this->pr_no,
            'po_date' => $this->po_date->format('Y-m-d'),
            'procurement_mode' => ucwords($this->procurement_mode),
            'supplier_name' => ucwords(strtolower($this->supplier)),
            'dept_name' => ucwords($this->dept_name),
            'delivery' => $this->delivery,
            'days' => $this->days,
            'total' => $this->total,
            'obrs' => $this->ors_burst,
            'fund_cluster' => $this->ors_burst_fund !== '' ? "0".$this->ors_burst_fund : '',
            'first_item' => strtok($this->first_item, "\n"),
            'items' => PoItemResource::collection($this->po_items),
            // 'iars' => IarResource::collection($this->iars),
        ];
    }
}
