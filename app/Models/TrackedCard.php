<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackedCard extends Model
{
    protected $fillable = [
        'card_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }
}
