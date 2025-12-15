<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'npm',
        'email',
        'phone',
        'role',
        'ktm_path',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
