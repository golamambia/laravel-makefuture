<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'av_order_tbl';
	public function getFullNameAttribute()
    {
        return "{$this->billing_first_name} {$this->billing_last_name}";
    }
}
