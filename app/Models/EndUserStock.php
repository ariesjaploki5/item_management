<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\EndUserStockCreated;
use App\Events\EndUserStockUpdated;

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

    protected $dispatchesEvents = [
        'created' => EndUserStockCreated::class,
        'updated' => EndUserStockUpdated::class,
    ];
}
