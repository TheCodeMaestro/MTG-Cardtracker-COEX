<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'card_name',
        'set',
        'set_name',
        'small_image_url',
        'normal_image_url',
        'usd_price',
        'eur_price',
    ];
}
