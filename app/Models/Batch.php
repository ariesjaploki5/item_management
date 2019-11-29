<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'mmo.dbo.batches';

    protected $primaryKey = 'batch_no';

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'batch_no' => 'string',
        'iar_no' => 'string', 
        'item_id' => 'string',
        'brand_id' => 'int',
        'cost' => 'decimal:4',
        'quantity' => 'decimal:4',
        'expiration_date' => 'data',
        'remarks' => 'string',
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
        'fund_cluster_id',
    ];

    public function iar(){
        return $this->belongsTo('App\Model\Iar');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id', 'item_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }

    public function batch_riss(){
        return $this->hasMany('App\Models\Batch', 'batch_no', 'batch_no');
    }

    
}
