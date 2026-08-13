<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'address',
        'total_price',
        'status',
    ];

    // Связь с позициями заказа
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
