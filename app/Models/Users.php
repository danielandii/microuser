<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //

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
