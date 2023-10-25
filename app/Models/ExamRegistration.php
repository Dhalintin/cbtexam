<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    public function exams()
    {
        return $this->hasMany(Exam::class, 'id', 'exam_id');
    }
}
