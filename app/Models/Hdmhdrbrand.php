<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hdmhdrbrand extends Model
{
    protected $table = "mmo.dbo.hdmhdrbrands";
    // protected $primaryKey = 'dmdcomb';
    public $incrementing = false;

    protected $fillable = [
        'dmdcomb', 'dmdctr',
        'dmdhdrsub', 'stockbal',
        'unit_price', 'selling_price',
        'statusMed', 'brand_id',
        'exp_date'
    ];
    
}
