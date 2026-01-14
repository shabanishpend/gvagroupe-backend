<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    public $table = 'job_categories';
    protected $fillable = [
        'title',
        'created_at',
        'updated_at'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'job_category_id');
    }
}
