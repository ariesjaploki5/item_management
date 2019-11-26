<?php

namespace App\MMO;

use Illuminate\Database\Eloquent\Model;

class Dv extends Model
{
    protected $table = 'mmo.dbo.dvs';

    protected $primaryKey = 'dv_no';
    public $incrementing = false;

    protected $fillable = [
        'dv_no', 'approving_officer_id', 'po_no'
    ];

    public function attachment_dvs(){
        return $this->hasMany('App\MMO\AttachmentDv', 'dv_no');
    }

    public function po(){
        return $this->belongsTo('App\PMO\Po', 'po_no', 'po_no');
    }

    public function approving_officer(){
        return $this->belongsTo('App\MMO\ApprovingOfficer', 'approving_officer_id', 'approving_officer_id');
    }
}
