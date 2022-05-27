<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Utils\FilteringUtil;

abstract class GetService
{

    protected $model;
    protected $searchable;

    public function __construct()
    {
        $this->model = new $this->model();
    }

    public function findAll()
    {
        return $this->model->paginate();
    }

    public function search($filters = "")
    {
        $filtering = new FilteringUtil(new $this->model(), $this->searchable);
        $queryBuilder = $filtering->resolveQuery($filters);
        return $queryBuilder->paginate();
    }

    public function find($id)
    {
        $record = $this->model::find($id);

        if(!$record)
            throw new ResourceNotFoundException($this->model->get_class());

        return $record;
    }
}