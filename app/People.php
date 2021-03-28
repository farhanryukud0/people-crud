<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = "peoples";
    protected $primaryKey = 'people_id';

    protected $fillable = ['name', 'email','phone'];
}
