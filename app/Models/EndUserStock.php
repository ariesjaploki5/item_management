<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndUserStock extends Model
{
    protected $table = 'mmo.dbo.end_user_stock';

    protected $fillable = [
        'sl_code', 
        'quantity', 
        'cost',
        'batch',
        'expiration_date',
        'batch_no',
        'remarks',
        'iar_no',
    ];
}
