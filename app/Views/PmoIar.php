<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class PmoIar extends Model
{
    protected $table = 'mmo.dbo.view_pmo_iars';
    protected $primaryKey = 'iar_no';

    public $incrementing = false;

    protected $casts = [
        'iar_no' => 'string', 
        'po_no' => 'string',
        
    ];

    protected $fillable = [
        'iar_no', 
        'po_no', 
        'inspection_officer_id', 
        'inspection_date',
        'receiving_officer_id',
        'received_date', 
        'ref_no', 
        'ref_date',
        'completed',
        'fund_cluster_id',
        'created_by',
    ];

    public function batches(){
        return $this->hasMany('App\PMO\Batch', 'iar_no');
    }

    public function po(){
        return $this->belongsTo('App\PMO\Po', 'po_no', 'po_no');
    }

    public function inspection_officer(){
        return $this->belongsTo('App\Models\InspectionOfficer', 'inspection_officer_id', 'inspection_officer_id');
    }

    public function receiving_officer(){
        return $this->belongsTo('App\Models\InspectionOfficer', 'receiving_officer_id', 'inspection_officer_id');
    }

    public function created_by(){
        return $this->belongsTo('App\User', 'id', 'created_by');
    }
}
