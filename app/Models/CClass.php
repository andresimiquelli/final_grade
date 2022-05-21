<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CClass extends Model
{
    use HasFactory;

    protected $table = "classes";

    protected $fillable = [
        'pack_id',
        'name',
        'start_at',
        'end_at',
        'status'
    ];

    public function getValidationRules()
    {
        return [
            'pack_id' => ['integer','required','exists:packs,id'],
            'name' => ['string','max:191','required'],
            'start_at' => ['date'],
            'end_at' => ['date'],
            'status' => ['integer','max:255','min:0']
        ];
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class,'pack_id','id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class,'class_id','id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class,'class_id','id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class,'class_id','id');
    }

    public function teacherAssignments()
    {
        return $this->hasMany(TeacherAssignment::class,'class_id','id');
    }
}
