<?php

namespace App\Services\Pack\Module;

use App\Exceptions\DeletionException;
use App\Models\PackModule;
use App\Models\PackModuleSubject;
use App\Services\DeleteService;

class PackModuleDeleteService extends DeleteService
{
    protected $model = PackModule::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];

    protected function deletionConstraints($obj)
    {
        $subjects = PackModuleSubject::where('pack_module_id',$obj->id)->count();

        if($subjects> 0)
            throw new DeletionException([ 'pack_module_subjects' => $subjects]);

        return $obj;
    }
}
