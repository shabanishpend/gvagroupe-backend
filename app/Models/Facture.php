<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory;
    use SoftDeletes;

    const Payed = 1;
    const NotPayed = 0;

    public $table = 'factures';
    protected $fillable = [
        'factured_city',
        'factured_date',
        'nr_plaque',
        'km_voiture',
        'pu_kw',
        'annee',
        'marque',
        'type',
        'chassis',
        'hml',
        'intervenation_date',
        'tvsh',
        'total_tva',
        'total_ttc',
        'total_hors_quantity',
        'total_hors_tva',
        'total_hors_price',
        'name',
        'status',
        'client_id',
        'cordialement',
        'user_id',
        'email_sended',
        'type_of_facture',
        'client_car_id',
        'website',
        'hide_car_details',
        'payable_end_time',
        'payable_date',
        'payment_method_mode',
        'subscription_type',
        'subscription_start_date',
        'subscription_end_date',
        'shipping_method',
        'shipping_date',
        'is_archived'
    ];

    public function items()
    {
        return $this->hasMany(FactureItem::class, 'facture_id');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function car()
    {
        return $this->hasOne(ClientCar::class, 'id', 'client_car_id');
    }

    public function emailHistory()
    {
        return $this->hasMany(FactureEmailHistory::class, 'facture_id');
    }
}
