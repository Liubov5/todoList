<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = ["text", "section_id"];


    public function section(){
    	return $this->belongsTo('App\Section');
    }

}
