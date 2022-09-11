<?php

namespace App\Services\Pack;

use App\Exceptions\DeletionException;
use App\Models\CClass;
use App\Models\Pack;
use App\Models\PackModule;
use App\Services\DeleteService;

class PackDeleteService extends DeleteService
{
    protected $model = Pack::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];

    protected function deletionConstraints($obj)
    {
        $modules = PackModule::where('pack_id',$obj->id)->count();
        $classes = CClass::where('pack_id',$obj->id)->count();

        if(($modules+$classes) > 0)
            throw new DeletionException([ 'pack_modules' => $modules, 'classes' => $classes]);

        return $obj;
    }
}
