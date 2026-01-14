<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterEmail extends Model
{
    use HasFactory;

    public $table = 'newsletter_emails';
    protected $fillable = [
        'email',
        'created_at',
        'updated_at'
    ];
}
