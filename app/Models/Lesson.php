<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'pack_module_subject_id',
        'reference'
    ];

    public function getValidationRules()
    {
        return [
            'class_id' => ['integer','required','exists:classes,id'],
            'pack_module_subject_id' => ['integer','required','exists:pack_module_subjects,id'],
            'reference' => ['date']
        ];
    }

    public function class()
    {
        return $this->belongsTo(CClass::class,'class_id','id');
    }

    public function pack_module_subject()
    {
        return $this->belongsTo(PackModuleSubject::class,'pack_module_subject_id','id');
    }

    public function absences()
    {
        return $this->hasMany(EnrollmentAbsence::class,'lesson_id','id');
    }

}
