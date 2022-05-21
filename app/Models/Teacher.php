<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function getValidationRules()
    {
        return [
            'user_id' => ['integer','required','exists:users,id']
        ];
    }

    public function user()
    {
         return $this->belongsTo(User::class,'user_id','id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class,'teacher_id','id');
    }

    public function assignments()
    {
        return $this->hasMany(TeacherAssignment::class,'teacher_id','id');
    }
}
