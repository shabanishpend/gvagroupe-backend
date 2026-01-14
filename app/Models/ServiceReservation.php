<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReservation extends Model
{
    use HasFactory;

    public $table = 'service_reservations';
    protected $fillable = [
        'type',
        'first_name',
        'last_name',
        'date',
        'time',
        'email',
        'phone',
        'car_brand',
        'car_model',
        'status',
        'registration_number',
        'created_at',
        'updated_at'
    ];
}
