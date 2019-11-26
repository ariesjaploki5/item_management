<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "mmo.dbo.brands";
    protected $primaryKey="brand_id";
    // public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'brand_desc'
    ];

    public function purchase_order_details(){
        return $this->hasMany('App\Models\PurchaseOrderDetail', 'brand_id', 'brand_id');
    }

    public function price_schedule_details(){
        return $this->hasMany('App\Models\PriceScheduleDetail', 'brand_id', 'brand_id');
    }

    public function batches(){
        return $this->hasMany('App\Models\Batches', 'brand_id', 'brand_id');
    }
}


