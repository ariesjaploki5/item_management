<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentDv extends Model
{
    protected $table = 'mmo.dbo.attachment_dv';

    public $incrementing = false;

    protected $fillable = [
        'dv_no', 'attachment_id', 'number_date_particulars'
    ];

    public function attachment(){
        return $this->belongsTo('App\Models\Attachment', 'attachment_id', 'attachment_id');
    }

    public function dv(){
        return $this->belongsTo('App\Models\Dv', 'dv_no', 'dv_no');
    }
}
