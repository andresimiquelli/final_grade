<?php 

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;

abstract class DeleteService
{
    protected $model;
    protected $nesteds;

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

        $exists->delete();
        return $exists;
    }

    private function resolveNesteds()
    {
        foreach($this->nesteds as $field => $value)
        {
            $this->model = $this->model->where($field, $value); 
        }
        
    }
}