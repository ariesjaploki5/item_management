<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetails extends Model
{
    protected $table = 'mmo.dbo.purchase_order_details';
    public $timestamps = false;
    protected $casts = [
        'po_no' => 'string',
        'item_id' => 'string'
    ];

    protected $fillable = [
        'po_no',
        'item_id',
        'brand_id',
        'packaging_id',
        'manufacturer_id',
        'country_id',
        'quantity',
        'cost',
        'remarks',
    ];
}
