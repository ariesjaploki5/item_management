<?php

namespace App\MMO;

use Illuminate\Database\Eloquent\Model;

class Iar extends Model
{
    protected $table = 'mmo.dbo.iars';
    protected $primaryKey = 'iar_no';

    public $incrementing = false;

    protected $casts = [
        'iar_no' => 'string', 
        'received_date' => 'date',
    ];

    protected $fillable = [
        'iar_no', 
        'po_no', 
        'inspection_officer_id', 
        'inspection_date',
        'received_date', 
        'ref_no', 
        'ref_date',
        'completed',
    ];


    

    public function batches(){
        return $this->hasMany('App\MMO\Batch', 'iar_no');
    }

    public function inspection_officer(){
        return $this->belongsTo('App\MMO\InspectionOfficer', 'inspection_officer_id', 'inspection_officer_id');
    }

    public function po(){
        return $this->belongsTo('App\PMO\Po', 'po_no', 'po_no');
    }

    public function purchase_order(){
        return $this->belongTo('App\Models\PurchaseOrder', 'po_no', 'po_no');
    }
}
