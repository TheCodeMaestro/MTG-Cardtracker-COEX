<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'id',
        'card_name',
        'set_name',
        'normal_image_url',
        'usd_price',
        'eur_price',
        'oracle_id',
        'cmc',
        'color_identity',
        'type_line',
        'oracle_text',
        'power',
        'toughness',
        'loyalty',
        'artist',
        'released_at',
    ];

    protected $casts = [
        'color_identity' => 'array',
    ];
}
