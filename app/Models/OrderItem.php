<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function product(){
        $this->belongsTo(\App\Models\Product::class);
    }
    public function order(){
        $this->belongsTo(\App\Models\Order::class);
    }
}
