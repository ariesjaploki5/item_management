<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class DvLiquidatedDamage extends Model
{
    protected $table = 'mmo.dbo.pmo_dv_liquidated_damages';

    protected $fillable = [
        'dv_no',
        'liquidated_damage',
        'tax',
    ];

    public function dv(){
        return $this->belongsTo('App\PMO\Dv', 'dv_no', 'dv_no');
    }
}
