<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCarModelsTranslation extends Model
{
    use HasFactory;

    public $table = 'buy_cars_models_translations';
    protected $fillable = [
        'name_en',
        'description_en',
        'name_de',
        'description_de',
        'model_id'
    ];
}
