<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $fillable = ['department_id', 'nama'];

    public function Department(){
    	return $this->belongsTo('App\Models\Department');
    }

    public function Users(){
    return $this->hasOne('App\Models\Users');
    }
}
