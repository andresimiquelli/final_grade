<?php

namespace App\Services\Journal;

use App\Exceptions\DataValidationException;
use App\Models\PackModuleSubject;
use App\Models\Subject;
use App\Services\GetService;
use App\Utils\FilteringUtil;

class JournalGetService extends GetService
{
    protected $model = PackModuleSubject::class;

    public function __construct()
    {
        $this->model = new $this->model();
        $this->builder = $this->model
        ->join('subjects','pack_module_subjects.subject_id','=','subjects.id')
        ->join('pack_modules','pack_module_subjects.pack_module_id','=','pack_modules.id')
        ->join('packs','pack_modules.pack_id','=','packs.id')
        ->select(
            'packs.course_id as course_id',
            'packs.id as pack_id',
            'packs.name as pack_name',            
            'pack_modules.name as pack_module_name',
            'subjects.id as subject_id',
            'subjects.name as subject_name',
            'pack_module_subjects.load as subject_load',
            'pack_module_subjects.order');
    }

    public function findAll($pack_id = null)
    {
        if(is_null($pack_id))
            throw new DataValidationException(['pack_id' => 'pack_id param shoul be present']);

        $result = $this->builder->where('packs.id',$pack_id)->paginate();
        return $result;
    }

    public function search($filters = "", $pack_id = null)
    {
        if(is_null($pack_id))
            throw new DataValidationException(['pack_id' => 'pack_id param shoul be present']);
        
        $this->builder = $this->builder->where('packs.id',$pack_id);
        $filtering = new FilteringUtil($this->builder,['subjects.name','pack_modules.name']);
        $this->builder = $filtering->resolveQuery($this->resolveQueryString($filters));
        return $this->builder->paginate();
    }

    private function resolveQueryString($query)
    {
        $result = str_replace('subject','subjects.name',$query);
        $result = str_replace('module','pack_modules.name',$query);
        return $result;
    }
}