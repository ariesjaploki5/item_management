<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table ='mmo.dbo.countries';
    protected $primaryKey="country_id";
    // public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'country_desc'
    ];
}
