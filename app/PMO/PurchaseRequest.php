<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $table = 'mmo.dbo.purchase_requests';
    protected $primaryKey = 'pr_no';
    public $incrementing = false;
    protected $casts = [
        'pr_no' => 'string',
        'purpose' => 'string',
        'user_id' => 'int'
    ]; 

    protected $fillable = [
        'pr_no', 'purpose', 'user_id',
    ];

    public function purchase_requeqst_details(){
        return $this->hasMany('App\PMO\PurchaseRequestDetails', 'pr_no', 'pr_no');
    }

    public function purchase_orders(){
        return $this->hasMany('App\PMO\PurchaseOrder', 'pr_no', 'pr_no');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
