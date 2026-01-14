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
        'description',
        'user_image',
        'user_full_name',
        'user_position'
    ];
}
