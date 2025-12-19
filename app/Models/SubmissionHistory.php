<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Submission;
use App\Models\User;

class SubmissionHistory extends Model
{
    protected $fillable = ['submission_id', 'user_id', 'action'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //
}
