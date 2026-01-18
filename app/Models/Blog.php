<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $table = 'blogs';
    protected $fillable = [
        'title',
        'title_fr',
        'title_en',
        'title_de',
        'title_sq',
        'title_it',
        'image',
        'user_id',
        'content',
        'content_fr',
        'content_en',
        'content_de',
        'content_sq',
        'content_it',
        'created_at',
        'updated_at'
    ];

    public function categories()
    {
        return $this->hasMany(BlogCategoryRelation::class, 'blog_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
}
