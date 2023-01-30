<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $fillable = [
        'sell_id',
        'total_price',
        'discount',
        'date',
        'state',
        'users_user_id',
        'clients_client_id',        
    ];
    public $timestamps = false;
}
