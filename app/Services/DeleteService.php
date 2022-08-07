<?php 

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;

abstract class DeleteService
{
    protected $model;
    protected $builder;
    protected $nesteds = [];
    protected $triggerBeforeDelete = [];
    protected $triggerAfterDelete = [];


    public function __construct(array $nesteds = [])
    {
        $this->model = new $this->model();
        $this->builder = $this->model->query();
        $this->nesteds = $nesteds;
    }

    public function delete($id)
    {
        $this->resolveNesteds();
        $exists = $this->builder->find($id);

        if(!$exists)
            throw new ResourceNotFoundException(get_class($this->model->make()));

        $result = $this->executeDeletion($exists);

        $this->clearQuery();

        return $result;
    }

    public function deleteBy($field, $value) 
    {
        $deleted = array();
        $result = $this->builder->where($field, $value)->get();
        
        foreach($result as $row)
        {
            $deleted = $this->executeDeletion($row);
        }

        $this->clearQuery();

        return $deleted;
    }

    public function deleteByFields(array $values) 
    {
        $deleted = array();

        foreach($values as $field => $value) 
        {
            $this->builder = $this->builder->where($field, $value);
        }

        $result = $this->builder->get();
        
        foreach($result as $row)
        {
            $deleted[] = $this->executeDeletion($row);
        }

        $this->clearQuery();
        
        return $deleted;
    }

    private function resolveNesteds()
    {
        foreach($this->nesteds as $field => $value)
        {
            $this->builder = $this->builder->where($field, $value); 
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

    private function clearQuery()
    {
        $this->builder = $this->model->newQuery();
    }
}