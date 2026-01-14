<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    use HasFactory;
    protected $table = 'projets_translations';
    protected $fillable = [
        'title_en',
        'title_de',
        'service_en',
        'service_de',
        'content_en',
        'content_de',
        'model_id',
        'created_at',
        'updated_at',
    ];
    
}
