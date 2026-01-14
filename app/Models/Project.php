<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $table = 'projects';
    protected $fillable = [
        'title',
        'image',
        'user_id',
        'year',
        'visit',
        'client',
        'service',
        'content',
        'video_url',
        'created_at',
        'updated_at'
    ];
    
    public function translation()
    {
        return $this->hasOne(ProjectTranslation::class, 'model_id');
    }
}
