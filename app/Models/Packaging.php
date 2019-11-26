<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    protected $table ='mmo.dbo.packagings';
    protected $primaryKey="packaging_id";
    // public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'packaging_desc'
    ];
}
