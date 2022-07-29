<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'cart_id',
        'member_id',
        'product_id',
        'product_name',
        'product_img',
        'price',
        'quantity'
    ];
}
