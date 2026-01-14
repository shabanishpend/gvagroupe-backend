<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costs extends Model
{
    use HasFactory;

    public $table = 'costs';

    protected $fillable = [
        'id',
        'category',
        'website',
        'file',
        'total_price',
        'payed_date',
        'catgory_id',
        'status',
        'title',
        'description',
        'sub_catgory_id',
        'mode_payment',
        'observations',
        'created_at',
        'updated_at'
    ];

    public function categoryAtached()
    {
        return $this->hasOne(CostCategory::class, 'id', 'catgory_id');
    }
}
