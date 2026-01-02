<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'event_id',
        'task_id',
        'task_id',
        'team_id',
        'user_id',
        'title',
        'file_path',
        'link_repository',
        'notes',
        'score',
        'answers',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'answers' => 'array',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function histories()
    {
        return $this->hasMany(SubmissionHistory::class)->orderByDesc('created_at');
    }
}
