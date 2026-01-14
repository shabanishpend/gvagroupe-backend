<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class CostCategory extends Model
{
    use HasFactory;
    public $table = 'cost_categories';

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function subCategory()
    {
        return $this->hasOne(SubCategory::class, 'catgory_id', 'id');
    }
}
