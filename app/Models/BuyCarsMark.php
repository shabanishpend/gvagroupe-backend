<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCarsMark extends Model
{
    use HasFactory;

    public $table = 'buy_cars_marks';
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at'
    ];

    public function translation()
    {
        return $this->hasOne(BuyCarMarksTranslation::class, 'model_id');
    }
}
