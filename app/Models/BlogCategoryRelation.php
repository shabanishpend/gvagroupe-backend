<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryRelation extends Model
{
    use HasFactory;

    protected $table = "blog_category";
    protected $fillable = [
        'blog_id',
        'category_id',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'category_id');
    }
}  
