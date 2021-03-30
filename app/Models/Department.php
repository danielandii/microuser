<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    protected $fillable = ['nama'];

    public function Users(){
        return $this->hasMany('App\Models\Users');
    }

    public function Jabatan(){
        return $this->hasMany('App\Models\Jabatan');
    }
}
