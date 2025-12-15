<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'registration_start',
        'registration_end',
        'event_start',
        'event_end',
        'max_members',
        'is_active',
    ];

    protected $casts = [
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'event_start' => 'datetime',
        'event_end' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
