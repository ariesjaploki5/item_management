<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class PmoPo extends Model
{
    protected $table = 'mmo.dbo.view_pmo_pos';
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
        ,"first_item" => 'string'
    ];

    public function po_items(){
        return $this->hasMany('App\Views\PmoPoDetail', 'po_no');
    }

    public function iars(){
        return $this->hasMany('App\PMO\Iar', 'po_no');
    }

    public function scopeMmo(){
        
    }
}
