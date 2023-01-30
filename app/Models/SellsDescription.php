<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellsDescription extends Model
{
    protected $table = 'sells_description';
    
    use HasFactory;
    protected $fillable = [
        'sells_description_id',
        'amount',
        'price',
        'sells_sell_id',
        'products_product_id',
        'services_service_id'        
    ];
    public $timestamps = false;
}
