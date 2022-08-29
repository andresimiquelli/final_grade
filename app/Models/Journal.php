<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'pack_module_subject_id',
        'status'
    ];

    public function getValidationRules()
    {
        return [
            'class_id' => ['integer','required','exists:classes,id'],
            'pack_module_subject_id' => ['integer','required','exists:pack_module_subjects,id']
        ];
    }

    public function cclass()
    {
        return $this->belongsTo(CClass::class,'class_id','id');
    }

    public function pack_module_subject()
    {
        return $this->belongsTo(PackModuleSubject::class,'pack_module_subject_id','id');
    }
}
