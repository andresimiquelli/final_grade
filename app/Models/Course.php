<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level'
    ];

    public function getValidationRules()
    {
        return [
            'name' => ['string','max:191','required'],
            'level' => ['integer','max:255','required']
        ];
    }

    public function packs()
    {
        return $this->hasMany(Pack::class,'course_id','id');
    }
}
