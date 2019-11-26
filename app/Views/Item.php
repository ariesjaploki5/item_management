<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "mmo.dbo.view_items";
    
    public function batches(){
        return $this->hasMany('App\Views\Batch', 'item_id', 'item_id');
    }
}
