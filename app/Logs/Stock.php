<?php

namespace App\Logs;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'mmo.dbo.stock_logs';

    protected $fillable = [
        'sl_code',
        'user_id',
        'quantity',
        'type_id',
    ];
}
