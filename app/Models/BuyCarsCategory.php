<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCarsCategory extends Model
{
    use HasFactory;

    public $table = 'buy_cars_categories';
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at'
    ];

    public function translation()
    {
        return $this->hasOne(BuyCarCategoryTranslation::class,'model_id');
    }
}
