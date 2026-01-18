<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';
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
        'user_image',
        'user_full_name',
        'user_position'
    ];
}
