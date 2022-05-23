<?php

namespace App\Utils;

use Illuminate\Support\Facades\Validator;

class DataValidator
{

    private $validationErrors;
    private $validationRules;

    public function __construct($validationRules)
    {
        $this->validationRules = $validationRules;
    }

    public function validate($data, $scapeWithoutFields = false)
    {
        $validationRules = $this->validationRules;
        
        if($scapeWithoutFields)
            $validationRules = $this->clearRules($data,$this->validationRules);

        $validator = Validator::make($data,$validationRules);
        
        $failed = $validator->fails();

        if($failed)
            $this->validationErrors = $validator->errors();

        return !$failed;
    }

    public function errors()
    {
        return $this->validationErrors;
    }

    private function clearRules($data, $validationRules)
    {
        return array_intersect_key($validationRules, $data);
    }
}