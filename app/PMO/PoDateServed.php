<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class PoDateServed extends Model
{
    protected $table = 'mmo.dbo.pmo_po_date_served';
    protected $primaryKey = 'po_no';

    protected $fillable = [
        'po_no',
        'date_served',
    ];

    public function po(){
        return $this->belongsTo('App\PMO\Po', 'po_no');
    }
}
