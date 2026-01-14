<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoRental extends Model
{
    use HasFactory;

    public $table = 'auto_rental';
    protected $fillable = [
        'name',
        'price',
        'fuel',
        'location',
        'mileage',
        'transmission',
        'performance',
        'seats',
        'doors',
        'status',
        'year',
        'description',
        'image_1',
        'image_2',
        'image_3',
        'date_from',
        'time_from',
        'date_to',
        'time_to',
        'created_at',
        'updated_at'
    ];

    public function translation()
    {
        return $this->hasOne(AutoRentalTranslation::class, 'model_id');
    }
}
