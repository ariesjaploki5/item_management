<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'mmo.dbo.purchase_orders';
    protected $primaryKey = 'po_no';
    public $incrementing = false;
    
    protected $casts = [
        'po_no' => 'string'
    ];

    protected $fillable = [
        'po_no', 'pr_no', 'supplier_id'
    ];

    public function purchase_order_details(){
        return $this->hasMany('App\PMO\PurchaseOrderDetails', 'po_no', 'po_no');
    }

    public function purchase_request(){
        return $this->belongsTo('App\PMO\PurchaseRequest', 'pr_no', 'pr_no');
    }
}
