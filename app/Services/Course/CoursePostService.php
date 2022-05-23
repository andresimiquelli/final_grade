<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Utils\DataValidator;
use App\Exceptions\DataValidationException;

class CoursePostService
{
    public function create($data)
    {
        $courses = new Course();
        $validator = new DataValidator($courses->getValidationRules());
        $validated = $validator->validate($data);

        if($validated)
        {
            $course = $courses->create($data);
            return $course;
        }
        else
        {
            throw new DataValidationException($validator->errors()->getMessages(), $data);
        }
    }

    public function update($id, $data)
    {

    
    }
}