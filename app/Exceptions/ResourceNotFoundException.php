<?php

namespace App\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{

    private $modelName;

    public function __construct($modelName)
    {
        $parts = explode("\\",$modelName);
        $this->modelName = end($parts);
    }

    public function render()
    {
        $error = new Error(Error::$DATABASE_ERROR, $this->modelName." not found.");
        return response()->json($error->toArray(),404);
    }
}