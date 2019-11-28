<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "mmo.dbo.view_employees";

    public function department(){
        return $this->belongsTo('App\Models\Department', 'department_id', 'department_id');
    }
}
