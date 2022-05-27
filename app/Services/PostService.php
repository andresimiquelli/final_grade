<?php

namespace App\Services;

use App\Exceptions\DataValidationException;
use App\Utils\DataValidator;

abstract class PostService
{
    protected $model;

    public function __construct()
    {
        $this->model = new $this->model();    
    }

    public function create($data)
    {
        $validator = new DataValidator($this->model->getValidationRules());
        $validated = $validator->validate($data);

        if($validated)
        {
            $course = $this->model->create($data);
            return $course;
        }
        else
        {
            throw new DataValidationException($validator->errors()->getMessages(), $data);
        }
    }
}