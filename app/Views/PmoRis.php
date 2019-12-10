<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class PmoRis extends Model
{
    protected $table = 'mmo.dbo.view_pmo_riss';
    protected $primaryKey = 'control_no';

    public $incrementing = false;

    protected $casts = [
        'control_no' => 'string',
        'ris_no' => 'string',
        'ris_date' => 'date',
        'requested_by' => 'int',
        'approved_by' => 'int',
        'issued_by' => 'int',
        'received_by' => 'int',
        'requested_date' => 'date',
        'approved_date' => 'date',
        'issued_date' => 'date',
        'received_date' => 'date',
    ];


    public function batches(){
        return $this->hasMany('App\PMO\BatchRis', 'control_no');
    }


}
