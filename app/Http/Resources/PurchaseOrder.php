<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PurchaseOrderDetail as PurchaseOrderDetailResource;
use App\Http\Resources\PurchaseOrderDetailView as PurchaseOrderDetailViewResource;
class PurchaseOrder extends JsonResource
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
            'po_date' => $this->po_date,
            'pr_no' => $this->pr_no,
            'supplier_id' => $this->supplier_id,
            'supplier_name' => $this->supplier->supplier_name,
            'supplier_address' => $this->supplier->supplier_address,
            'served_date' => $this->served_date,
            'mode_id' => $this->mode_id,
            'mode_desc' => $this->mode->mode_desc,
            'items' => PurchaseOrderDetailViewResource::collection(($this->view_details)),
        ];
    }
}
