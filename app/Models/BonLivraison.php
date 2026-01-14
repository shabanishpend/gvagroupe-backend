<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraison extends Model
{
    use HasFactory;

    public $table = 'bon_livraison';
    protected $fillable = [
        'date',
        'number_de_bon',
        'website',
        'article',
        'article_description',
        'client_id'
    ];


    public function items()
    {
        return $this->hasMany(BonLivrasionItem::class, 'bon_livraison_id');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id','client_id');
    }
}
