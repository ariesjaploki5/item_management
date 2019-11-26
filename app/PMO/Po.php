<?php

namespace App\PMO;

use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
    protected $table = 'bms_pmo.dbo.bms_po';
    protected $primaryKey = 'po_no';


    protected $casts = [
        "id" => 'string'
        ,"pr_no" => 'string'
        ,"po_no" => 'string'
        ,"po_date" => 'date'
        ,"procurement_mode" => 'string'
        ,"supplier" => 'string'
        ,"dept_name" => 'string'
        ,"delivery" => 'string'
        ,"days" => 'int'
        ,"total" => 'float'
        ,"ors_burst" => 'string'
        ,"ors_burst_fund" => 'string'

    ];

    public function po_items(){
        return $this->hasMany('App\Views\PmoPoDetail', 'po_no');
    }

    public function iars(){
        return $this->hasMany('App\Models\Iar', 'po_no', 'po_no');
    }

    public function scopeMmo(){
        
    }
}
