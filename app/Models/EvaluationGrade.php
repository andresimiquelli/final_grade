<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_id',
        'enrollment_id',
        'value'
    ];

    public function getValidationRules()
    {
        return [
            'evaluation_id' => ['integer','required','exists:teachers,id'],
            'enrollment_id' => ['integer','required','exists:classes,id'],
            'value' => ['integer','max:255','min:0']
        ];
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class,'evaluation_id','id');
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class,'enrollment_id','id');
    }
}
