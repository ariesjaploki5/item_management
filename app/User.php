<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'item_management.dbo.users';

    use HasApiTokens, Notifiable;

    protected $fillable = [
        'username', 'password', 'role_id', 'employee_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function findForPassport($username) { 
        return $this->where('username', $username)->first();
    }

    public function ris_requesteds(){
        return $this->hasMany('App\Models\Ris', 'requested_by', 'id');
    }

    public function ris_issueds(){
        return $this->hasMany('App\Models\Ris', 'issued_by', 'id');
    }

    public function ris_approveds(){
        return $this->hasMany('App\Models\Ris', 'approved_by', 'id');
    }

    public function purchase_requests(){
        return $this->hasMany('App\Model\PurchaseRequest');
    }

    public function purchase_orders(){
        return $this->hasMany('App\Models\PurchaseOrder');
    }

    public function employee(){
        return $this->belongsTo('App\Models\Employee', 'employee_id', 'employee_id');
    }
    
}
