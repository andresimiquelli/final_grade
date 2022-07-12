<?php 

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;

abstract class DeleteService
{
    protected $model;
    protected $nesteds = [];
    protected $triggerBeforeDelete = [];
    protected $triggerAfterDelete = [];


    public function __construct(array $nesteds = [])
    {
        $this->model = new $this->model();
        $this->nesteds = $nesteds;
    }

    public function delete($id)
    {
        $this->resolveNesteds();
        $exists = $this->model->find($id);

        if(!$exists)
            throw new ResourceNotFoundException(get_class($this->model->make()));

        return $this->executeDeletion($exists);
    }

    public function deleteBy($field, $value) 
    {
        $deleted = array();
        $result = $this->model->where($field, $value)->get();
        
        foreach($result as $row)
        {
            $deleted = $this->executeDeletion($row);
        }

        return $deleted;
    }

    private function resolveNesteds()
    {
        foreach($this->nesteds as $field => $value)
        {
            $this->model = $this->model->where($field, $value); 
        }
        
    }

    private function trigger(array $triggers, $obj = null) {
        foreach($triggers as $trigger)
        {
            $obj = $this->$trigger($obj);
        }

        return $obj;
    }

    private function executeDeletion($entity)
    {
        $entity = $this->trigger($this->triggerBeforeDelete, $entity);
        $entity->delete();
        $entity = $this->trigger($this->triggerAfterDelete, $entity);
        return $entity;
    }
}