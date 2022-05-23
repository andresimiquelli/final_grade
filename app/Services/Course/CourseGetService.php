<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Utils\FilteringUtil;

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
        $filtering = new FilteringUtil(new Course(), $this->searchable);
        $queryBuilder = $filtering->resolveQuery($filters);
        return $queryBuilder->paginate();
    }
}