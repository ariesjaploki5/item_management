<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item_management.dbo.items';
    protected $primaryKey = 'item_id';
    public $incrementing = false;

    protected $casts = [
        'item_id' => 'string'
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id', 'category_id');
    }
}
