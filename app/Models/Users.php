<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //

    protected $fillable = ['username','password', 'department_id', 'jabatan_id', 'nama', 'alamat', 'email', 'telp'];

    protected $hidden = [
        'password',
    ];

    public function department(){
    	return $this->belongsTo('App\Models\department');
    }
}
