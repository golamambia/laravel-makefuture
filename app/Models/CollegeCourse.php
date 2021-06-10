<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeCourse extends Model
{
    protected $table = 'mf_college_course';
	public $timestamps = false;
    protected $fillable = [
        'course_id',
        'college_id',
    ];
}
