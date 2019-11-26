<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovingOfficer extends Model
{
    protected $table = 'mmo.dbo.approving_officers';
    protected $primaryKey = 'approving_officer_id';
    public $timestamps = false;

    public function dvs(){
        return $this->hasMany('App\Models\Dv', 'approving_officer_id', 'approving_officer_id');
    }
}
