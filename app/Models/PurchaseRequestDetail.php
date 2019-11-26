<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestDetail extends Model
{
    protected $table = 'mmo.dbo.purchase_request_details';
    protected $primaryKey = 'prd_id';
    public $timestamps = false;

    protected $fillable = [
        'pr_no',
        'item_id',
        'cost',
        'quantity',
    ];

    protected $casts = [
        'pr_no' => 'string',
        'item_id' => 'string',

    ];

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'pr_no', 'pr_no');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id', 'item_id');
    }

    
}
