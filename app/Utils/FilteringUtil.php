<?php

namespace App\Utils;

use Exception;

class FilteringUtil
{
    private $model;
    private $searchable;

    public function __construct($modelClass, $searchable = [])
    {
        $this->searchable = $searchable;

        try
        {
            $this->model = new $modelClass();
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }

    public function resolveQuery($filters)
    {
        $params = $this->unfold($filters);
        $params = $this->clearQuery($params);
        return $this->build($params);
    }

    private function unfold($filters)
    {
        $fields = explode(",",$filters);
        $params = array();

        foreach($fields as $content)
        {
            $parts = explode(":",$content);
            $nparts = count($parts);
            
            switch($nparts)
            {
                case 1:
                    $params[$parts[0]] = [1];
                    break;
                case 2:
                    $params[$parts[0]] = [$parts[1]];
                    break;
                case 3:
                    $params[$parts[0]] = [$parts[1],$parts[2]];
                    break;
            }

        }

        return $params;
    }

    private function clearQuery($params)
    {
        if(count($this->searchable) > 0)
        {
            $nparams = array();

            foreach($this->searchable as $sfield)
            {
                if(array_key_exists($sfield, $params))
                    $nparams[$sfield] = $params[$sfield];
            }

            return $nparams;
        }

        return $params;
    }

    private function build($params)
    {
        $builder = $this->model;

        foreach($params as $field => $values)
        {
            $nval = count($values);

            switch($nval)
            {
                case 1:
                    $builder = $builder->where($field,$values[0]);
                    break;
                case 2:
                    $builder = $builder->where($field,$values[0],$values[1]);
                    break;
            }
        }

        return $builder;
    }
}