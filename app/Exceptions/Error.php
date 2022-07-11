<?php

namespace App\Exceptions;

class Error
{
    public static $VALIDATION_ERROR = 1;
    public static $SERVICE_ERROR = 2;
    public static $DATABASE_ERROR = 3;
    public static $AUTHORIZATION_ERROR = 4;
    
    private $type;
    private $message;
    private $errors;
    private $data;

    public function __construct(int $type, string $message = null, array $errors = null, $data = null)
    {
        $this->type = $type;
        $this->message = $message;
        $this->errors = $errors;
        $this->data = $data;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getData()
    {
        return $this->data;
    }

    public function toArray()
    {
        $error['type'] = $this->type;
        $error['message'] = $this->message;
        $error['errors'] = $this->errors;
        $error['data'] = $this->data;

        return $error;
    }
}