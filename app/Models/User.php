<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\Payment;

class User extends Authenticatable
{
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function currentSubscription()
    {
    return $this->subscriptions()
        ->whereIn('status', ['active', 'on_trial'])
        ->latest('starts_at')
        ->first();
    }

    public function currentPlan()
    {
    $subscription = $this->currentSubscription();
    return $subscription ? $subscription->plan : null;
    }
    
    public function remainingProjects(): ?int
    {
    $plan = $this->currentPlan();
    if (! $plan || $plan->max_projects === null) {
        return null;
    }

    return $plan->max_projects - $this->projects()->count();
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
    
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
