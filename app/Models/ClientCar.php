<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientCar extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "clients_cars";
    protected $fillable = [
        'nr_plaques',
        'km_voiture',
        'pu_kw',
        'annee',
        'marque',
        'type',
        'chassis',
        'hml',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }

}
