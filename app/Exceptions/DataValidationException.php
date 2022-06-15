<?php

namespace App\Exceptions;

use Exception;

class DataValidationException extends Exception
{

    private $errors = array();
    private $data = array();

    public function __construct(array $errors, array $data = [])
    {
        $this->errors = $errors;
        $this->data = $data;
    }

    public function render()
    {
        $error = new Error(Error::$VALIDATION_ERROR, "Validation errors.",$this->errors, $this->data);
        return response()->json($error->toArray(),400);
    }
}