<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferAnnual extends Model
{
    use HasFactory;

    public $table = 'offers_annual';

    protected $fillable = [
        'type',
        'website',
        'cars_number',
        'price',
        'price_discount',
        'total_price',
        'conditions',
        'signature_footer',
        'footer_text',
        'client_id',
        'services'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
