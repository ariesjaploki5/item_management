<?php

namespace App\MMO;

use Illuminate\Database\Eloquent\Model;

class ItemRis extends Model
{
    protected $table = 'mmo.dbo.item_ris';

    public $timestamps = false;

    protected $fillable = [
        'ris_no',
        'item_id',
        'requested_quantity',
        'issued_quantity',
        'batch_no',
    ];

    protected $cast = [
        'ris_no' => 'string',
        'item_id' => 'string',
        'requested_quantity',
        'issued_quantity',
        'batch_no',
    ];

    public function ris(){
        return $this->belongsTo('App\MMO\RIS', 'ris_no', 'ris_no');
    }

    public function item(){
        return $this->belongsTo('App\Item', 'item_id', 'item_id');
    }

    public function item_ris_issuances(){
        return $this->hasMany('App\Models\ItemRisIssuance', 'item_ris_id', 'item_ris_id');
    }

    
}
