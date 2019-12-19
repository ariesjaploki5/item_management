<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'mmo.dbo.items_2';
    protected $primaryKey = 'mmo.dbo.item_id';
    public $incrementing = false;

    protected $casts = [
        'item_id' => 'string'
    ];

    protected $fillable = [
        'item_id', 'item_desc', 'category_id', 'unit_desc'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }

    public function batches(){
        return $this->hasMany('App\Models\Batch', 'item_id', 'item_id');
    }
}
