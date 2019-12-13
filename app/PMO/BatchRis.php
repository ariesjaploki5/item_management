<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class BatchRis extends Model
{
    protected $table = 'mmo.dbo.pmo_batch_ris';
    protected $primaryKey ='batch_ris_id';

    public $timestamps = false;

    protected $casts = [
        'batch_no' => 'string',
        'control_no' => "string",
        'requested_quantity' => 'decimal:2',
        'issued_quantity' => 'decimal:2',
    ];

    protected $fillable = [
        'batch_no',
        'control_no',
        'requested_quantity',
        'issued_quantity',
        'batch_control_no',
    ];

    public function batch(){
        return $this->belongsTo('App\PMO\Batch', 'batch_control_no', 'batch_control_no');
    }

    public function ris(){
        return $this->belongsTo('App\PMO\Ris', 'control_no', 'control_no');
    }
}
