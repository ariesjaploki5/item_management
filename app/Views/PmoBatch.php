<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class PmoBatch extends Model
{
    protected $table = "mmo.dbo.view_pmo_batches";

    public function iar(){
        return $this->belongsTo('App\Pmo\Iar');
    }
}
