<?php

namespace App\Services\Finalgrade;

use App\Models\Enrollment;
use App\Models\EnrollmentAbsence;
use App\Models\EvaluationGrade;
use Illuminate\Support\Facades\DB;

class FinalGradeReportService {

    public function report($class_id, $subject_id) {
        $enrollments = Enrollment::select('enrollments.id','students.name','enrollments.class_id')
            ->join('students','enrollments.student_id', '=', 'students.id')
            ->where('enrollments.class_id', $class_id)
            ->orderBy('students.name')
            ->get();

        $result = [];
        
        foreach($enrollments as $enrollment) {
            $absences = EnrollmentAbsence::join('lessons', 'enrollment_absences.lesson_id', '=', 'lessons.id')
                ->where('enrollment_absences.enrollment_id',$enrollment->id)
                ->where('lessons.pack_module_subject_id',$subject_id)
                ->count();

            $grade = EvaluationGrade::select(DB::raw('sum(evaluation_grades.value) as total'))
                ->join('evaluations', 'evaluation_grades.evaluation_id', '=', 'evaluations.id')
                ->where('evaluation_grades.enrollment_id', $enrollment->id)
                ->where('evaluations.pack_module_subject_id', $subject_id)
                ->get();
    
            $result[] = [
                'enrollment_id' => $enrollment->id,
                'class_id' => $enrollment->class_id,
                'pack_module_subject_id' => $subject_id,
                'student_name' =>  $enrollment->name,
                'absences' => $absences,
                'grade' => $grade[0]->total
            ];

        }

        return $result;
    }
}