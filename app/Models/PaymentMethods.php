<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    protected $fillable = ['description', 'is_active', 'config'];

    protected $casts = [
        'is_active' => 'boolean',
        'config' => 'array', 
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donations::class);
    }
}
