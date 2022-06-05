<?php

namespace App\Services;

use App\Exceptions\DataValidationException;
use App\Utils\DataValidator;

abstract class PostService
{
    protected $model;
    protected $nesteds = [];

    public function __construct(array $nesteds = [])
    {
        $this->model = new $this->model();
        $this->nesteds = $nesteds;
    }

    public function create($data)
    {
        $data = $this->resolveNesteds($data);
        
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

    private function resolveNesteds($data)
    {
        foreach($this->nesteds as $field => $value)
        {
            $data[$field] = $value;
        }

        return $data;
    }
}