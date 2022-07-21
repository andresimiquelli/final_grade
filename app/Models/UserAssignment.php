<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'subject_id',
        'start_at',
        'end_at'
    ];

    public function getValidationRules()
    {
        return [
            'user_id' => ['integer','required','exists:users,id'],
            'class_id' => ['integer','required','exists:classes,id'],
            'subject_id' => ['integer','required','exists:subjects,id'],
            'start_at' => ['date'],
            'end_at' => ['date']
        ];
    }

    public function teacher()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function cclass()
    {
        return $this->belongsTo(CClass::class,'class_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
