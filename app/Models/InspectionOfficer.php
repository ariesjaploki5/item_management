<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionOfficer extends Model
{
    protected $table = 'mmo.dbo.inspection_officers';
    protected $primaryKey = 'inspection_officer_id';
    public $timestamps = false;

    protected $fillable = [
        'name', 'position'
    ];

    public function iars(){
        return $this->hasMany('App\MMO\Iar', 'inspection_officer_id', 'inspection_officer_id');
    }
}
