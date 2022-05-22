<?php

namespace App\Services\Course;

use App\Models\Course;

class CourseGetService 
{

    private $searchable = [
        'name',
        'level'
    ];

    public function findAll()
    {
        return Course::paginate();
    }

    public function search($filters = "")
    {

    }
}