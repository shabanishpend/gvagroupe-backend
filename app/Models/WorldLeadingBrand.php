<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorldLeadingBrand extends Model
{
    use HasFactory;

    protected $table = 'world_leading_brands';
    protected $fillable = [
        'title',
        'description',
        'link',
        'image',
        'created_at',
        'updated_at'
    ];
}
