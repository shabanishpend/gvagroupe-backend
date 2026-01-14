<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoRentalTranslation extends Model
{
    use HasFactory;

    protected $table = 'auto_rental_translations';
    protected $fillable = [
        'name_en',
        'name_de',
        'fuel_en',
        'fuel_de',
        'mileage_en',
        'mileage_de',
        'transmission_en',
        'transmission_de',
        'performance_en',
        'performance_de',
        'seats_en',
        'seats_de',
        'doors_en',
        'doors_de',
        'description_en',
        'description_de',
        'model_id',
        'created_at',
        'updated_at'
    ];
}
