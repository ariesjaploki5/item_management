<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemRisIssuance extends Model
{
    protected $table = 'mmo.dbo.item_ris_issuances';

    public $timestamps = false;

    protected $fillable = [
        'item_ris_id',
        'issued_quantity',
        'batch_no',
    ];

    protected $casts = [
        'item_ris_id' => 'int',
        'issued_quantity' => 'float',
        'batch_no' => 'string',
    ];

    public function item_ris(){
        return $this->belongsTo('App\MMO\ItemRis', 'item_ris_id', 'item_ris_id');
    }

    public function batch(){
        return $this->belongsTo('App\MMO\Batch', 'batch_no', 'batch_no');
    }
}
