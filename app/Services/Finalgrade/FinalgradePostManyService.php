<?php

namespace App\Services\Finalgrade;

use App\Models\Finalgrade;

class FinalgradePostManyService
{

    private $model = Finalgrade::class;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function saveAll(array $grades)
    {
        $result = [];

        foreach($grades as $grade)
        {
            $exists = Finalgrade::where(
                [
                    'enrollment_id' => $grade['enrollment_id'],
                    'pack_module_subject_id' => $grade['pack_module_subject_id']
                ]
            )->first();

            if($exists) {
                $exists->value = $grade['value'];
                $exists->absences = $grade['absences'];
                $exists->save();
                $result[] = $exists;
            } else {
                $result[] = $this->model->create($grade);
            }
        }

        return $result;
    }
}
