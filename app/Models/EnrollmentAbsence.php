<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentAbsence extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'lesson_id'
    ];

    public function getValidationRules()
    {
        return [
            'enrollment_id' => ['integer','required','exists:enrollments,id'],
            'lesson_id' => ['integer','required','exists:lessons,id']
        ];
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class,'enrollment_id','id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lessons::class,'lesson_id','id');
    }
}
