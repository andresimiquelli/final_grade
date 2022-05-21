<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'description'
    ];

    public function getValidationRules()
    {
        return [
            'course_id' => ['integer','required','exists:courses,id'],
            'description' => ['string','max:256']
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function classes()
    {
        return $this->hasMany(CClass::class,'pack_id','id');
    }

    public function modules()
    {
        return $this->hasMany(PackModule::class,'pack_id','id');
    }
}
