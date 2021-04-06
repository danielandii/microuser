<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Lumen\Auth\Authorizable;

class Users extends Model implements AuthenticatableContract, AuthorizableContract
{
    //
    use HasApiTokens, Authenticatable, Authorizable, HasFactory;

protected $fillable = ['username','password', 'department_id', 'jabatan_id',  'nama', 'alamat', 'email', 'telp', 'api_token'];

    protected $hidden = [
        'password',  'api_token'
    ];

    public function department(){
    	return $this->belongsTo('App\Models\Department');
    }
    public function jabatan(){
    	return $this->belongsTo('App\Models\Jabatan');
    }
}
