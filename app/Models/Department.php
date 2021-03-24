<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    protected $fillable = ['nama'];

    public function users(){
        return $this->hasMany('App\Models\Users');
    }

    public function jabatan(){
        return $this->hasMany('App\Models\Jabatan');
    }
}
