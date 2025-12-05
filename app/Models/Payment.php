<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subscription_id',
        'plan_id',
        'amount',
        'currency',
        'status',
        'provider',
        'provider_payment_id',
        'provider_raw_response',
        'invoice_number',
        'description',
        'paid_at',
        'failed_at',
        'refunded_at',
    ];

    protected $casts = [
        'amount'                 => 'integer',
        'provider_raw_response'  => 'array',
        'paid_at'                => 'datetime',
        'failed_at'              => 'datetime',
        'refunded_at'            => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
