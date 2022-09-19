<?php

namespace App\Services;

abstract class ReorderService {

    protected $model;

    public function __construct()
    {
        $this->model = new $this->model();
    }

    public function reorder(array $ids)
    {
        $index = 1;
        foreach($ids as $id) {
           $entity = $this->model::find($id);
           $entity->order = $index;
           $entity->save();
           $index++;
        }
    }
}
