<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class PoItem extends Model
{
    protected $table = 'bms_pmo.dbo.bms_po_items';
    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'int'
        ,'po_id' => 'int'
        ,'po_item_conno' => 'string'
        ,'description' => 'string'
        ,'item_unit' => 'string'
        ,'item_qty' => 'float'
        ,'item_cost' => 'float'
        ,'item_ecost' => 'float'
        ,'item_other_details' => 'string'
        ,'i_notes' => 'string'
        ,'item_po_id' => 'int'
        ,'brand' => 'string'
        ,'manufacturer' => 'string'
        ,'item_code' => 'string'
    ];
    public function po_items(){
        return $this->hasMany('App\PMO\PoItem');
    }
}
