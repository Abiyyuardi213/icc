<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'name',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
    
    // Helpers
    public function getLeaderAttribute()
    {
        return $this->members->where('role', 'leader')->first();
    }
    
    public function getMember1Attribute()
    {
        return $this->members->where('role', 'member')->skip(0)->first();
    }

    public function getMember2Attribute()
    {
        return $this->members->where('role', 'member')->skip(1)->first();
    }
    
    public function getLeaderNameAttribute() { return $this->leader?->name; }
    public function getLeaderNpmAttribute() { return $this->leader?->npm; }
    public function getLeaderPhoneAttribute() { return $this->leader?->phone; }
    
    public function getMember1NameAttribute() { return $this->member1?->name; }
    public function getMember1NpmAttribute() { return $this->member1?->npm; }
    
    public function getMember2NameAttribute() { return $this->member2?->name; }
    public function getMember2NpmAttribute() { return $this->member2?->npm; }
    
    public function getCategoryAttribute() { return $this->event->name; } // Mapped from event name
}
