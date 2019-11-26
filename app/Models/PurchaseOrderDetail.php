<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $primaryKey = 'pod_id';
    protected $table = 'mmo.dbo.purchase_order_details';

    public $timestamps = false;

    protected $fillable = [
        'po_no', 
        'item_id', 
        'cost', 
        'quantity', 
        'brand_id', 
        'manufacturer_id', 
        'packaging_id', 
        'country_id', 
        'other_details',
        'offer',
    ];

    protected $casts = [
        'po_no' => 'string', 
        'item_id' => 'string', 

    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'po_no', 'po_no');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id', 'item_id');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country', 'country_id', 'country_id');
    }

    public function packaging(){
        return $this->belongsTo('App\Models\Packaging', 'packaging_id', 'packaging_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }

    public function manufacturer(){
        return $this->belongsTo('App\Models\Manufacturer', 'manufacturer_id', 'manufacturer_id');
    }
}
