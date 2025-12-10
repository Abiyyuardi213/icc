<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_type',
        'team_name',
        'leader_name',
        'leader_npm',
        'leader_email',
        'leader_phone',
        'member_1_name',
        'member_1_npm',
        'member_2_name',
        'member_2_npm',
    ];
}
