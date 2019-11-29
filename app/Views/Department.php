<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "mmo.dbo.view_departments";
    protected $primaryKey = 'department_id';
}
