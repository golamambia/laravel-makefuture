<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
	protected $table = 'av_earning_tbl';
	protected $fillable = ['order_id'];
}
