<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMemberTranslation extends Model
{
    use HasFactory;

    protected $table = 'team_members_translations';
    protected $fillable = [
        'position_en',
        'position_de',
        'model_id',
        'created_at',
        'updated_at',
    ];
    
}
