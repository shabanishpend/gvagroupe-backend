<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCarImage extends Model
{
    use HasFactory;

    public $table = 'buy_cars_images';
    protected $fillable = [
        'name',
        'buy_cars_id',
        'created_at',
        'updated_at'
    ];
}
