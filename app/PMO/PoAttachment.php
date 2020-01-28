<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class PoAttachment extends Model
{
    protected $table = 'mmo.dbo.pmo_po_attachments';

    protected $fillable = [
        'po_no',
        'attachment_id',
        'number_date_particulars'
    ];

    public function attachment(){
        return $this->belongsTo('App\Models\Attachment', 'attachment_id', 'attachment_id');
    }

    public function dv(){
        return $this->belongsTo('App\Models\Dv', 'po_no', 'po_no');
    }

    public function po(){
        return $this->belongsTo('App\Models\Po', 'po_no', 'po_no');
    }
}
