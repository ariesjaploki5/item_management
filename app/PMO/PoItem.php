<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class PoItem extends Model
{
    protected $table = 'bms_pmo.dbo.bms_po_items';
    protected $primaryKey = 'id';

    public function po_items(){
        return $this->hasMany('App\PMO\PoItem');
    }
}
