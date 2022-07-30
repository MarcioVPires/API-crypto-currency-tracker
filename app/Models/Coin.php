<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;
    protected $fillable = [
        'coin_id',
        'symbol',
        'name',
        'image',
        'current_price',
        'market_cap',
        'total_volume',
        'favorite',
        'price_change_percentage_24h',
        'price_change_percentage_1h_in_currency'
    ];
}
