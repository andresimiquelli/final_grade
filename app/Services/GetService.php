<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Utils\FilteringUtil;

abstract class GetService
{

    protected $model;
    protected $searchable;
    protected $nesteds = [];

    public function __construct(array $nesteds = [])
    {
        $this->model = new $this->model();
        $this->nesteds = $nesteds;
    }

    public function findAll()
    {
        $this->resolveNesteds();

        return $this->model->paginate();
    }

    public function search($filters = "")
    {
        $this->resolveNesteds();
        $filtering = new FilteringUtil(new $this->model(), $this->searchable);
        $this->model = $filtering->resolveQuery($filters);
        return $this->model->paginate();
    }

    public function find($id)
    {
        $record = $this->model->find($id);

        if(!$record)
            throw new ResourceNotFoundException(get_class($this->model));

        return $record;
    }

    private function resolveNesteds()
    {
        foreach($this->nesteds as $field => $value)
        {
            $this->model = $this->model->where($field, $value); 
        }
    }
}