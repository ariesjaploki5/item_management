<?php

namespace App\MMO;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'mmo.dbo.items';
    protected $primaryKey = 'item_id';

    public $incrementing = false;

    protected $fillable = [
        'item_id', 'item_desc', 'unit_id', 'unit_desc',
    ];

    protected $casts = [
        'item_id' => 'string',
        'item_desc' => 'string',
        'unit_id' => 'int',
        'unit_desc' => 'string',
        'ssl' => 'int',
    ]; 

    public function purchase_order_details(){

    }

    public function purchase_request_details(){

    }

    public function batches(){

    }

    public function unit(){

    }

    public function item_riss(){

    }

    public function item_ppmps(){

    }

    public function app_items(){

    }

    public function item_price_schedules(){

    }


}
