<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'mmo.dbo.employees';
    protected $primaryKey = 'employee_id';

    public $incrementing = false;
    public $timestamps = false;

    public function user(){
        return $this->hasOne('App\User', 'employee_id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department', 'department_id', 'department_id');
    }
}
