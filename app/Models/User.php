<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
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
        'google_id',
        'is_premium',
        'subscription_expires_at',
        'profile',
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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'subscription_expires_at' => 'datetime',
        'is_premium' => 'boolean'
    ];

    // Scope untuk mengecek apakah premium masih aktif
    public function scopeActivePremium($query)
    {
        return $query->where('is_premium', true)
            ->where('subscription_expires_at', '>', now());
    }

    // Method untuk mengecek status premium
    public function hasActivePremium()
    {
        return $this->is_premium && $this->subscription_expires_at !== null && $this->subscription_expires_at->isFuture();
    }


    // Method untuk mengaktifkan premium
    public function activatePremium($durationInDays = 30)
    {
        $this->update([
            'is_premium' => true,
            'subscription_expires_at' => now()->addDays($durationInDays)
        ]);
    }

    // Method untuk menonaktifkan premium
    public function deactivatePremium()
    {
        $this->update([
            'is_premium' => false,
            'subscription_expires_at' => null
        ]);
    }

    public function isPro(): bool
    {
        return $this->is_premium && ($this->subscription_expires_at === null || $this->subscription_expires_at->isFuture());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
