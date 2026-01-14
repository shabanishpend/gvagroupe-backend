<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCarsModel extends Model
{
    use HasFactory;
    public $table = 'buy_cars_models';
    protected $fillable = [
        'name',
        'description',
        'buy_cars_marks_id',
        'created_at',
        'updated_at'
    ];

    public function mark()
    {
        return $this->hasOne(BuyCarsMark::class, 'id', 'buy_cars_marks_id');
    }

    public function translation()
    {
        return $this->hasOne(BuyCarModelsTranslation::class, 'model_id');
    }
}
