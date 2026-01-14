<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'company',
        'budget',
        'message',
        'type',
        'created_at',
        'updated_at'
    ];
}
