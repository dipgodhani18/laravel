<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'card_id',
        'name',
        'card_no',
        'brand',
        'month',
        'year',
        'created_at',
        'updated_at',
    ];
}
