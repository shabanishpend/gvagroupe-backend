<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    public $table = 'blogs_categories';
    protected $fillable = [
        'title',
        'title_fr',
        'title_en',
        'title_de',
        'title_sq',
        'title_it',
        'description',
        'description_fr',
        'description_en',
        'description_de',
        'description_sq',
        'description_it',
        'created_at',
        'updated_at'
    ];
}
