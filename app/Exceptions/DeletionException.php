<?php

namespace App\Exceptions;

use Exception;

class DeletionException extends Exception
{

    private $errors = [];

    public function __construct(array $errors = [])
    {
        $this->errors = $errors;
    }

    public function render()
    {
        $error = new Error(Error::$DATABASE_ERROR, "Deletion forbidden.", $this->errors);
        return response()->json($error->toArray(),403);
    }
}