<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user';

    protected $fillable = [
        'user_id',
        'role_id',
        'created_at',
        'updated_at'
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
