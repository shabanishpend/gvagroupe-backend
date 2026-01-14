<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public $table = 'activities';
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'type',
        'created_at',
        'updated_at'
    ];
}
