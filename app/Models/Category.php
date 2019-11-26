<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $table = "mmo.dbo.categories";

    public $timestamps = false;
    
    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id', 'item_id');
    }
}
