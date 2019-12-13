<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemRis extends Model
{
    protected $table = 'mmo.dbo.item_ris';
    protected $primaryKey = 'item_ris_id';

    public $timestamps = false;
    protected $casts = [
        'item_id' => 'string'
    ];

    protected $fillable = [
        'item_id', 'control_no', 'requested_quantity', 'issued_quantity'
    ];

    public function ris(){
        return $this->belongsTo('App\Models\Ris', 'control_no', 'control_no');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id', 'item_id');
    }
}
