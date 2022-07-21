<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'pack_module_subject_id',
        'name',
        'value'
    ];

    public function getValidationRules()
    {
        return [
            'user_id' => ['integer','required','exists:users,id'],
            'class_id' => ['integer','required','exists:classes,id'],
            'pack_module_subject_id' => ['integer','required','exists:pack_module_subjects,id'],
            'name' => ['string','max:191','required'],
            'value' => ['integer','max:255','min:0']
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

    public function packModuleSubject()
    {
        return $this->belongsTo(PackModuleSubject::class,'pack_module_subject_id','id');
    }

    public function grades()
    {
        return $this->hasMany(EvaluationGrade::class,'evaluation_id','id');
    }
}
