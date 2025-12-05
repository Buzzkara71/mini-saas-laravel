<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_monthly',
        'price_yearly',
        'currency',
        'is_active',
        'max_projects',
        'max_users',
        'data',
        'sort_order',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'price_monthly'=> 'integer',
        'price_yearly' => 'integer',
        'max_projects' => 'integer',
        'max_users'    => 'integer',
        'data'         => 'array',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
