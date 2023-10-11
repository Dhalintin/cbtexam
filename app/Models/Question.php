<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'course_id',
        'type',
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer:: class, 'question_id', 'id');
    }
}
