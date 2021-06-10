<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyformExam extends Model
{
    protected $table = 'mf_applyform_exam';
	// public $timestamps = false;
    protected $fillable = [
        'applyform_id',
        'subject_name',
    ];
}
