<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name'];

    public function students() {
        return $this->hasMany('App\Student');
    }

    public function courses() {
        return $this->hasMany('App\Course');
    }
}
