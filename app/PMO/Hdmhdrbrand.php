<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class Hdmhdrbrand extends Model
{
    protected $table = "mmo.dbo.pmo_hdmhdrbrands";
    // protected $primaryKey = 'dmdcomb';
    public $incrementing = false;

    protected $fillable = [
        'dmdcomb', 'dmdctr',
        'dmdhdrsub', 'stockbal',
        'unit_price', 'selling_price',
        'statusMed', 'brand',
        'exp_date', 'batch_no'
    ];
}
