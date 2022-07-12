<?php

namespace App\Exceptions;

use Exception;

class DeletionException extends Exception
{
    public function render()
    {
        $error = new Error(Error::$DATABASE_ERROR, "Deletion forbidden.");
        return response()->json($error->toArray(),403);
    }
}