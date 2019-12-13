<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ris extends Model
{
    protected $table = 'mmo.dbo.riss';
    protected $primaryKey = 'control_no';

    public $incrementing = false;

    protected $casts = [
        'control_no' => 'string',
        'ris_no' => 'string',
        'ris_date' => 'date',
        'requested_by' => 'int',
        'approved_by' => 'int',
        'issued_by' => 'int',
        'received_by' => 'int',
        'requested_date' => 'date',
        'approved_date' => 'date',
        'issued_date' => 'date',
        'received_date' => 'date',
    ];

    protected $fillable = [
        'control_no', 
        'ris_no',
        'ris_date',
        'requested_by',
        'approved_by',
        'issued_by',
        'received_by',
        'requested_date',
        'approved_date',
        'issued_date',
        'received_date',
        'purpose',
        'category_id',
    ];

    public function batches(){
        return $this->hasMany('App\Models\BatchRis', 'control_no');
    }

    public function item_ris(){
        return $this->hasMany('App\Models\ItemRis', 'control_no');
    }

    public function requested_by_user(){
        return $this->belongsTo('App\User', 'requested_by', 'id');
    }

    public function approved_by_user(){
        return $this->belongsTo('App\User', 'approved_by', 'id');
    }

    public function issued_by_user(){
        return $this->belongsTo('App\User', 'issued_by', 'id');
    }

    public function received_by_user(){
        return $this->belongsTo('App\User', 'received_by', 'id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }
}
