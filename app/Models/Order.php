<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function status() {
        return $this->belongsTo(Status::class);
    }
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
