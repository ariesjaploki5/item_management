<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table ='mmo.dbo.manufacturers';
    protected $primaryKey="manufacturer_id";
    // public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'manufacturer_desc'
    ];
}
