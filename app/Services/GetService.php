<?php

namespace App\Services;

use App\Exceptions\RelationshipException;
use App\Exceptions\ResourceNotFoundException;
use App\Utils\FilteringUtil;

abstract class GetService
{

    protected $model;
    protected $searchable = [];
    protected $with_fields = [];
    protected $builder;

    private $nesteds = [];
    private $relationships = [];

    public function __construct(array $nesteds = [])
    {
        $this->model = new $this->model();
        $this->builder = $this->model->query();
        $this->nesteds = $nesteds;
    }

    public function setRelationships(array $relationships)
    {
        $this->relationships = $relationships;
    }

    public function findAll()
    {
        $this->resolveRelationships();
        $this->resolveNesteds();

        return $this->builder->paginate();
    }

    public function search($filters = "")
    {
        $this->resolveRelationships();
        $this->resolveNesteds();
        $filtering = new FilteringUtil($this->builder, $this->searchable);
        $this->builder = $filtering->resolveQuery($filters);
        return $this->builder->paginate();
    }

    public function find($id)
    {
        $this->resolveRelationships();

        $record = $this->builder->find($id);

        if(!$record)
            throw new ResourceNotFoundException(get_class($this->model));

        return $record;
    }

    private function resolveNesteds()
    {
        foreach($this->nesteds as $field => $value)
        {
            $this->builder = $this->builder->where($field, $value); 
        }
    }

    private function resolveRelationships()
    {
        $forsearch[0] = "";
        $forsearch = array_merge($forsearch, $this->with_fields);

        foreach($this->relationships as $field) 
        {
            $ffield = trim(strtolower($field));
            if(strlen($ffield) > 0) 
            {
                if(array_search($ffield, $forsearch, true) > 0)
                    $this->builder = $this->builder->with(trim($field));
                else
                    throw new RelationshipException($field);
            }
        }
    }
}