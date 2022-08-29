<?php

namespace App\Services\Journal;

use App\Exceptions\DataValidationException;
use App\Models\Journal;
use App\Utils\DataValidator;

class JournalPostService
{
    public function createOrUpdate(array $data)
    {
        $model = new Journal();
        $validator = new DataValidator($model->getValidationRules());
        $validated = $validator->validate($data);

        if($validated)
        {
            $journal = Journal::where([
                'class_id' => $data['class_id'], 
                'pack_module_subject_id' => $data['pack_module_subject_id']
            ])->first();
    
            if($journal)
            {
                $journal->status = $data['status'];
                $journal->save();
            }
            else
            {
                $journal = Journal::create($data);
            }
    
            return $journal;
        }
        else
        {
            throw new DataValidationException($validator->errors()->getMessages(), $data);
        }
    }
}