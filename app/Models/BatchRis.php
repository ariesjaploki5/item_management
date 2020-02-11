<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchRis extends Model
{
    protected $table = 'mmo.dbo.batch_ris';
    protected $primaryKey ='batch_ris_id';

    public $timestamps = false;

    protected $casts = [
        'batch_no' => 'string',
        'control_no' => "string",
        'requested_quantity' => 'decimal:2',
        'issued_quantity' => 'decimal:2',
        'item_desc' => 'string'
    ];

    protected $fillable = [
        'batch_no',
        'control_no',
        'requested_quantity',
        'issued_quantity',
        'item_desc'
    ];

    public function batch(){
        return $this->belongsTo('App\MMO\Batch', 'batch_no', 'batch_no');
    }

    public function ris(){
        return $this->belongsTo('App\MMO\Ris', 'control_no', 'control_no');
    }
}
