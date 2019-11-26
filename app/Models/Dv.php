<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dv extends Model
{
    protected $table = 'mmo.dbo.dvs';
    protected $primaryKey = 'dv_no';
    public $incrementing = false;

    protected $fillabel = [
        'dv_no',
        'po_no',
        'approving_officer_id',
    ];

    public function attachment_dvs(){
        return $this->hasMany('App\Models\AttachmentDv', 'dv_no', 'dv_no');
    }

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'po_no', 'po_no');
    }

    public function approving_officer(){
        return $this->belongsTo('App\Models\ApprovingOfficer', 'approving_officer_id', 'approving_officer_id');
    }
}
