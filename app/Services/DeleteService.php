<?php 

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;

abstract class DeleteService
{
    protected $model;

    public function __construct()
    {
        $this->model = new $this->model();
    }

    public function delete($id)
    {
        $exists = $this->model->find($id);

        if(!$exists)
            throw new ResourceNotFoundException($this->model->get_class());

        $this->model->destroy(['id' => $exists->id]);
        return $exists;
    }
}