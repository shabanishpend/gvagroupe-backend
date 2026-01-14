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
        'image',
        'user_id',
        'content',
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
