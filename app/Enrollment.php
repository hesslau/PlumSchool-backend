<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Enrollment extends Model
{
    protected $fillable = ['student_id','course_id'];
}
