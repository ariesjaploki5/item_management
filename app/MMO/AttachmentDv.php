<?php

namespace App\MMO;

use Illuminate\Database\Eloquent\Model;

class AttachmentDv extends Model
{
    protected $table = 'mmo.dbo.attachment_dv';
    
    protected $fillable = [
        'dv_no', 'attachment_id', 'number_date_particulars'
    ];

    public function dv(){
        return $this->belongsTo('App\MMO\DV', 'dv_no', 'dv_no');
    }

    public function attachment(){
        return $this->belongsTo('App\MMO\Attachment', 'attachment_id', 'attachment_id');
    }
}
