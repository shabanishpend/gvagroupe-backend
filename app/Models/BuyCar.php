<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCar extends Model
{
    use HasFactory;

    public $table = 'buy_cars';
    protected $fillable = [
        'name',
        'price',
        'fuel',
        'mileage',
        'transmission',
        'address',
        'performance',
        'seats',
        'doors',
        'status',
        'year',
        'chasie_number',
        'carroserie',
        'carroserie_code',
        'expertise',
        'color',
        'registration_number',
        'type_approval',
        'cilindre',
        'power_kw',
        'weight_no_loaded',
        'weight_loaded',
        'weight_full_loaded',
        'roof_weight',
        'emission_code',
        'buy_cars_marks_id',
        'buy_cars_models_id',
        'buy_cars_category',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'image_6',
        'image_7',
        'image_8',
        'image_9',
        'image_10',
        'created_at',
        'updated_at'
    ];

    public function model()
    {
        return $this->hasOne(BuyCarsModel::class, 'id', 'buy_cars_models_id');
    }

    public function mark()
    {
        return $this->hasOne(BuyCarsMark::class, 'id', 'buy_cars_marks_id');
    }

    public function category()
    {
        return $this->hasOne(BuyCarsCategory::class, 'id', 'buy_cars_category');
    }

    public function translation()
    {
        return $this->hasOne(BuyCarsTranslation::class,'model_id');
    }

}
