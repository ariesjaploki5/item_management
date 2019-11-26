<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'mmo.dbo.suppliers';
    protected $primaryKey = 'supplier_id';
    public $timestamps = false;

    protected $fillable = [
        'supplier_id',
        'supplier_name',
        'zip_code',
        'tin',
        'tax_registration',
        'business_form',
        'income_tax',
        'tel_no',
        'tax_id',
    ];

    public function purchase_order(){
        return $this->hasMany('App\Models\PurchaseOrder', 'supplier_id', 'supplier_id');
    }
}
