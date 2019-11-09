<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $table = 'order_detail';
    
    public $fillable = [
        'order_id',
        'product_description',
        'price',
        'quantity',
    ];

    protected $casts = [
        'order_detail_id' => 'integer',
        'order_id' => 'integer',
        'product_description' => 'string',
        'price' => 'decimal',
        'quantity' => 'integer',
    ];

}
