<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $table = "mmo.dbo.view_purchase_order_details";

    protected $casts = [
        'po_no' => 'string'
    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'po_no', 'po_no');
    }
}
