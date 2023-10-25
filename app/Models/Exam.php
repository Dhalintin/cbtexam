<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamAttempt;

class Exam extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'exam_name',
        'course_id',
        'date',
        'time',
        'attempt',
    ];

    protected $appends = ['attempt_counter'];

    public $count = '';

    public function courses()
    {
        return $this->hasMany(Course::class, 'id', 'course_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'course_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer:: class, 'question_id', 'id');
    }

    public function getIdAttribute($value)
    {
        $attemptCount = ExamAttempt::where(['exam_id'=>$value, 'user_id'=>auth()->user()->id])->count();
        $this->count = $attemptCount;
        return $value;
    }

    public function getAttemptCounterAttribute()
    {
        return $this->count;
    }
}
