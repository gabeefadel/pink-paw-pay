<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'uuid'; 
    public $incrementing = false;   
    protected $keyType = 'string'; 

    protected $fillable = [
        'name', 'email', 'password', 'document', 'phone', 
        'role', 'status', 'failed_attempts', 'blocked_until'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'blocked_until' => 'datetime',
        'password' => 'hashed',
    ];

    
    public function address(): HasOne
    {
        return $this->hasOne(UserAddress::class, 'user_uuid', 'uuid');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donations::class, 'user_uuid', 'uuid');
    }
}
