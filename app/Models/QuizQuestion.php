<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'question_text', 'media_path', 'time_limit'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function options()
    {
        return $this->hasMany(QuizOption::class);
    }
}
