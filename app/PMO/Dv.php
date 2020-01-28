<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class Dv extends Model
{
    protected $table = 'mmo.dbo.pmo_dvs';
    protected $primaryKey = 'dv_no';
    
    protected $casts = [
        'dv_no' => 'string',
        'po_no' => 'string',
        'approving_officer_id' => 'int',
    ];

    protected $fillable = [
        'dv_no',
        'po_no',
        'approving_officer_id',
    ];

    public function liquidated_damages(){
        return $this->hasMany('App\PMO\DvLiquidatedDamage', 'dv_no', 'dv_no');
    }

    public function attachments(){
        return $this->hasMany('App\PMO\PoAttachment', 'po_no', 'po_no');
    }
}
