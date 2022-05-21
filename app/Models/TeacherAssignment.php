<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_id',
        'subject_id',
        'start_at',
        'end_at'
    ];

    public function getValidationRules()
    {
        return [
            'teacher_id' => ['integer','required','exists:teachers,id'],
            'class_id' => ['integer','required','exists:classes,id'],
            'subject_id' => ['integer','required','exists:subjects,id'],
            'start_at' => ['date'],
            'end_at' => ['date']
        ];
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id','id');
    }

    public function class()
    {
        return $this->belongsTo(CClass::class,'class_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
