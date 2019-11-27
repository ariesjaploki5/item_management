<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'mmo.dbo.purchase_orders';
    protected $primaryKey = 'po_no';

    protected $fillable = [
        'po_no',
        'pr_no',
        'supplier_id',
        'mode_id',
        'user_id',
        'served_date',
        'days',
    ];

    protected $casts = [
        'po_no' => 'string',
        'pr_no' => 'string',
    ];

    public function details(){
        return $this->hasMany('App\Models\PurchaseOrderDetail', 'po_no', 'po_no');
    }

    public function view_details(){
        return $this->hasMany('App\Views\PurchaseOrderDetail', 'po_no', 'po_no');
    }

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'pr_no', 'pr_no');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
    }

    public function mode(){
        return $this->belongsTo('App\Models\Mode', 'mode_id', 'mode_id');
    }

    public function iars(){
        return $this->hasMany('App\Models\Iar', 'po_no', 'po_no');
    }
}
