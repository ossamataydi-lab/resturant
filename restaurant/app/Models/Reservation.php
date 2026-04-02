<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['customer_name', 'customer_phone', 'reservation_time','guests_count','status' ];
}
