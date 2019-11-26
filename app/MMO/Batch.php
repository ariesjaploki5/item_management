<?php

namespace App\MMO;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'mmo.dbo.batches';

    protected $primaryKey = 'batch_no';

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'iar_no' => 'string', 
    ];
    
    protected $fillable = [
        'batch_no', 
        'iar_no',
        'item_id', 
        'brand_id', 
        'cost', 
        'quantity',
        'expiration_date', 
        'remarks',
    ];

    

    public function iar(){
        return $this->belongsTo('App\MMO\Iar');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id', 'item_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }
    
}
