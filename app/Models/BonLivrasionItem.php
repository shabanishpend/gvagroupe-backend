<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivrasionItem extends Model
{
    use HasFactory;

    public $table = 'bon_livraison_items';
    protected $fillable = [
        'title',
        'imei',
        'nr_cart_sim',
        'bon_livraison_id',
    ];
}
