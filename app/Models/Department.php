<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table ="mmo.dbo.departments";
    protected $primaryKey = "department_id";

    public $timestamps = false;

    public function division(){
        return $this->belongsTo('App\Models\Division', 'division_id', 'division_id');
    }
}
