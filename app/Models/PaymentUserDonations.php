<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentUserDonation extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_uuid', 'payment_method_id', 'transaction_code', 
        'session_id', 'ip_address', 'user_agent', 
        'encrypted_payload', 'card_last_four', 'card_brand', 
        'is_processed', 'expires_at'
    ];

    protected $casts = [
        'is_processed' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
