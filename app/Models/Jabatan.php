<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $fillable = ['department_id', 'nama'];

    public function department(){
    	return $this->belongsTo('App\Models\department');
    }
}
