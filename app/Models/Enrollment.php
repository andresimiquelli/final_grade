<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
        'start_at',
        'end_at',
        'status'
    ];

    public function getValidationRules()
    {
        return [
            'student_id' => ['integer','required','exists:students,id'],
            'class_id' => ['integer','required','exists:classes,id'],
            'start_at' => ['date'],
            'end_at' => ['date'],
            'status' => ['integer','max:255','min:0']
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function cclass()
    {
        return $this->belongsTo(CClass::class,'class_id','id');
    }

    public function absences()
    {
        return $this->hasMany(EnrollmentAbsence::class,'enrollment_id','id');
    }

    public function grades()
    {
        return $this->hasMany(EvaluationGrade::class,'enrollment_id','id');
    }

    public function finalgrades()
    {
        return $this->hasMany(Finalgrade::class,'enrollment_id','id');
    }
}
