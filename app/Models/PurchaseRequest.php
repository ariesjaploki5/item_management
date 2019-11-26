<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $table = 'mmo.dbo.purchase_requests';
    protected $primaryKey = 'pr_no';
    public $incrementing = false;

    protected $fillable = [
        'pr_no', 
        'category_id', 
        'user_id',
        'purpose',
    ];

    protected $casts = [
        'pr_no' => 'string',
    ];

    public function purchase_orders(){
        return $this->hasMany('App\Models\PurchaseOrder', 'pr_no', 'pr_no');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function details(){
        return $this->hasMany('App\Models\PurchaseRequestDetail', 'pr_no', 'pr_no');
    }

}
