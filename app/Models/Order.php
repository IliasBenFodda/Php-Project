<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','name','email','address','total','status'];
    public const STATUSES = ['pending','processing','shipped','completed','cancelled'];
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
