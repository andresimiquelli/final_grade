<?php

namespace App\Services;

use App\Exceptions\DataValidationException;
use App\Utils\DataValidator;

abstract class PostService
{
    protected $model;
    protected $nesteds = [];
    protected $unique_fields = [];
    protected $update_if_exists = true;
    protected $relationships = [];

    protected $triggerBeforeStore = [];
    protected $triggerAfterStore = []; 

    public function __construct(array $nesteds = [])
    {
        $this->model = new $this->model();
        $this->nesteds = $nesteds;
    }

    public function setRelationships(array $relationships)
    {
        $this->relationships = $relationships;
    }

    public function create($data)
    {
        $data = $this->resolveNesteds($data);
        
        $validator = new DataValidator($this->model->getValidationRules());
        $validated = $validator->validate($data);

        if($validated)
        {
            if(count($this->unique_fields) > 0)
            {
                $exists = $this->exists($data);
                if($exists)
                {
                    if($this->update_if_exists)
                    {
                        $exists->fill($data);
                        $exists->save(); 
                    }
                    
                    return $exists;
                }
            }

            $data = $this->trigger($this->triggerBeforeStore, $data);

            $result = $this->model->create($data);

            foreach($this->relationships as $rel)
            {
                $result->$rel;
            }

            $result = $this->trigger($this->triggerAfterStore, $result);

            return $result;
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

    private function exists($data)
    {
        if(count($this->unique_fields) > 0)
        {
            $model = $this->model->make();
            foreach($this->unique_fields as $field)
            {
                if(key_exists($field, $data))
                    $model = $model->where($field, $data[$field]);
            }
            
            $exists = $model->first();

            if($exists)
                return $exists;
        }

        return false;
    }

    private function trigger(array $triggers, $obj = null) {
        foreach($triggers as $trigger)
        {
            $obj = $this->$trigger($obj);
        }

        return $obj;
    }
}