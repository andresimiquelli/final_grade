<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    public function getValidationRules()
    {
        return [
            'name' => ['string','max:191','required'],
            'email' => ['email','max:191','nullable'],
            'phone' => ['string','max:15','nullable']
        ];
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class,'student_id','id');
    }
}
