<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
	protected $table = 'mf_referral';
    protected $fillable = [
        'user_id',
        'referred_by',
    ];
}
