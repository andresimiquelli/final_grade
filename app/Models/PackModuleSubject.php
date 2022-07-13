<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackModuleSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'pack_id',
        'pack_module_id',
        'subject_id',
        'load',
        'order'
    ];

    public function getValidationRules()
    {
        return [
            'pack_id' => ['integer','required','exists:packs,id'],
            'pack_module_id' => ['integer','required','exists:pack_modules,id'],
            'subject_id' => ['integer','required','exists:subjects,id'],
            'load' => ['integer','max:65535', 'min:0'],
            'order' => ['integer','max:16777215','min:0']
        ];
    }

    public function module()
    {
        return $this->belongsTo(PackModule::class,'pack_module_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class,'pack_module_subject_id','id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class,'pack_module_subject_id','id');
    }
}
