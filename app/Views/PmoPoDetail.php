<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class PmoPoDetail extends Model
{
    protected $table = "mmo.dbo.view_pmo_po_details";

    protected $casts = [
        'po_no' => 'string'
    ];


}
