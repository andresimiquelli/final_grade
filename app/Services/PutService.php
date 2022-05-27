<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Utils\DataValidator;

abstract class PutService
{

    protected $model;

    public function __construct()
    {
        $this->model = new $this->model();
    }

    public function update($id, $data)
    {
        $validator = new DataValidator($this->model->getValidationRules());
        $validated = $validator->validate($data, true);

        if($validated)
        {
            $exists = $this->model->find($id);

            if(!$exists)
                throw new ResourceNotFoundException($this->model->get_class());

            $exists->fill($data);
            $exists->save();

            return $exists;
        }
    }
}