<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Utils\DataValidator;

abstract class PutService
{

    protected $model;
    protected $nesteds;

    public function __construct(array $nesteds = [])
    {
        $this->model = new $this->model();
        $this->nesteds = $nesteds;
    }

    public function update($id, $data)
    {
        $validator = new DataValidator($this->model->getValidationRules());
        $validated = $validator->validate($data, true);

        if($validated)
        {
            $this->resolveNesteds();
            $exists = $this->model->find($id);

            if(!$exists)
                throw new ResourceNotFoundException(get_class($this->model->make()));

            $exists->fill($data);
            $exists->save();

            return $exists;
        }
    }

    private function resolveNesteds()
    {
        foreach($this->nesteds as $field => $value)
        {
            $this->model = $this->model->where($field, $value); 
        }
        
    }
}