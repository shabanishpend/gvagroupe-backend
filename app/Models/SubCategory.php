<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public $table = 'cost_sub_categories';

    protected $fillable = [
        'name',
        'catgory_id',
        'description',
    ];

    public function category()
    {
        return $this->hasOne(CostCategory::class, 'id', 'catgory_id');
    }
}
