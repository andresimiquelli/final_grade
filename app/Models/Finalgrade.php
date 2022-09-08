<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finalgrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'pack_module_subject_id',
        'value',
        'absences'
    ];

    public function getValidationRules()
    {
        return [
            'enrollment_id' => ['integer','required'],
            'pack_module_subject_id' => ['integer','required'],
            'value' => ['integer','max:255','min:0'],
            'absences' => ['integer','max:65535','min:0']
        ];
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class,'enrollment_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(PackModuleSubject::class,'pack_module_subject_id','id');
    }
}
