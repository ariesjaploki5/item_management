<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'mmo.dbo.attachments';
    protected $primaryKey = 'attachment_id';

    public $timestamps = false;


    public function attachment_dv(){
        return $this->hasMany('App\Models\AttachmentDv', 'attachment_id', 'attachment_id');
    }
}
