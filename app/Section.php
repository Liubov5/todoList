<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ["name"];


    public function challenges(){
    	return $this->hasMany('App\Challenge');
    }
}
