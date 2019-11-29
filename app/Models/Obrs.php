<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obrs extends Model
{
    protected $table = 'mmo.dbo.obrs';
    protected $fillable = [
        'po_no', 'obrs_no', 'fund_cluster_id'
    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'po_no', 'po_no');
    }
}
