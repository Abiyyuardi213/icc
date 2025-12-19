<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'event_id',
        'task_id',
        'team_id',
        'title',
        'file_path',
        'link_repository',
        'notes',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
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
