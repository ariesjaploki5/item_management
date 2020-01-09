<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestDetails extends Model
{
    protected $table = 'mmo.dbo.purchase_request_details';
    public $timestamps = false;

    protected $fillable = [
        'pr_no', 
        'item_id', 
        'cost', 
        'quantity', 
        'remarks',
    ];

    protected $casts = [
        'pr_no' => 'string',
        'item_id' => 'string',
        'cost' => 'float',
        'quantity' => 'decimal(18, 2)',
        'purpose' => 'string'
    ];

    public function purchase_request(){
        return $this->belongsTo('App\PMO\PurchaseRequest', 'pr_no', 'pr_no');
    }

    public function item(){
        return $this->belongsTo('App\Item', 'item_id', 'item_id');
    }
}
