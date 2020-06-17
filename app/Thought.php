<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thought extends Model
{
    protected $fillable = ["text", "date", "user_id"];
}
