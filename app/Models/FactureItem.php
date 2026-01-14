<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FactureItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'factures_items';
    protected $fillable = [
        'title',
        'prix_unitaire',
        'quantity',
        'total_chf',
        'facture_id',
        'position'
    ];
}
