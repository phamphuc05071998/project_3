<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_products');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
}
}
