<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
        'purchase_price',
        'sale_price',
        'stock',
        'original_stock',
        'state',
        'registration_date',
        'description'
    ];
    public $timestamps = false;
}
