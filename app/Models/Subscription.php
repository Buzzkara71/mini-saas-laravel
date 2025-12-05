<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    /**
     * Field yang boleh di-mass assign.
     */
    protected $fillable = [
        'user_id',
        'plan_id',
        'name',
        'status',
        'trial_ends_at',
        'starts_at',
        'ends_at',
        'canceled_at',
        'renews_at',
        'payment_gateway',
        'gateway_subscription_id',
        'meta',
    ];

    /**
     * Casting kolom.
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'starts_at'     => 'datetime',
        'ends_at'       => 'datetime',
        'canceled_at'   => 'datetime',
        'renews_at'     => 'datetime',
        'meta'          => 'array',
    ];

    /**
     * Relasi ke user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke plan.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Relasi ke payments (pembayaran yang terkait subscription ini).
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
