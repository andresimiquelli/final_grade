<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'pack_id',
        'name',
        'description',
        'order'
    ];

    public function getValidationRules()
    {
        return [
            'pack_id' => ['integer','required','exists:packs,id'],
            'name' => ['string','max:191','required'],
            'description' => ['string','max:256'],
            'order' => ['integer','max:16777215','min:0']
        ];
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class,'pack_id','id');
    }

    public function packModuleSubjects()
    {
        return $this->hasMany(PackModuleSubject::class,'pack_module_id','id');
    }
}
