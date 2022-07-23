<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Utils\DataValidator;

abstract class PutService
{

    protected $model;
    protected $nesteds;
    protected $relationships = [];

    protected $triggerBeforeUpdate = [];
    protected $triggerAfterUpdate = []; 

    public function __construct(array $nesteds = [])
    {
        $this->model = new $this->model();
        $this->nesteds = $nesteds;
    }

    public function setRelationships(array $relationships) {
        $this->relationships = $relationships;
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

            $old = $exists->all();
            $data = $this->trigger($this->triggerBeforeUpdate, $data, $old);
            
            $exists->fill($data);
            $exists->save();

            $exists = $this->trigger($this->triggerAfterUpdate, $exists, $old);

            foreach($this->relationships as $rel) {
                $exists->$rel;
            }

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

    private function trigger(array $triggers, $obj = null, $old = null) {
        foreach($triggers as $trigger)
        {
            $obj = $this->$trigger($obj, $old);
        }

        return $obj;
    }
}