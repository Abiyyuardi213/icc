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

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
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
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function participant()
    {
        // Alias for team, as used in Dashboard
        return $this->hasOne(Team::class);
    }
    
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    // Helper to get team for specific event
    public function teamForEvent($eventId)
    {
        return $this->teams()->where('event_id', $eventId)->first();
    }
    
    // Alias for Dashboard single team access (if needed temporarily, but best to refactor usages)
    // Deprecated: logic moving to support multiple teams
    public function team()
    {
        return $this->hasOne(Team::class)->latest(); // Fallback to latest team
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
