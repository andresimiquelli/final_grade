<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function getValidationRules()
    {
        return [
            'name' => ['string','max:191','required'],
            'description' => ['string','max:256']
        ];
    }

    public function finalgrades()
    {
        return $this->hasMany(Finalgrade::class,'subject_id','id');
    }

    public function packModuleSubjects()
    {
        return $this->hasMany(PackModuleSubject::class,'subject_id','id');
    }

    public function teacherAssignments()
    {
        return $this->hasMany(TeacherAssignment::class,'subject_id','id');
    }
}
