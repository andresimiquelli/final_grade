<?php

namespace App\Exceptions;

use Exception;

class RelationshipException extends Exception
{
    private $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function render()
    {
        $error = new Error(Error::$DATABASE_ERROR, "There is no relationship with ".$this->field.".");
        return response()->json($error->toArray(),404);
    }
}
