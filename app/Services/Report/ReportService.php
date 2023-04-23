<?php

namespace App\Services\Report;

use App\Models\CClass;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\PackModuleSubject;
use DateTime;
use stdClass;

class ReportService {

    public function attendanceReport($classId, $packModuleSubjectId) {
        $enrollmentModel = new Enrollment();
        $lessonModel = new Lesson();

        $enrollments = $enrollmentModel
            ->select("enrollments.id as id", "students.name as name", "enrollments.start_at as startAt")
            ->where("enrollments.class_id", $classId)
            ->join('students', 'students.id', '=', 'enrollments.student_id')
            ->orderBy('students.name')->get();

        $lessons = $lessonModel
            ->where("class_id", $classId)
            ->with('absences')
            ->where("pack_module_subject_id", $packModuleSubjectId)
            ->orderBy("reference")
            ->get();

        $references = [];

        foreach($lessons as $lesson) {
            $references[] = date_format(date_create($lesson->reference), 'd/m');
        }

        $header = $this->genHeader($classId, $packModuleSubjectId);

        $data = [];
        $totals = [];

        foreach($enrollments as $enrollment) {
            $totalAbsences = 0;
            foreach($lessons as $lesson) {
                $absences = $lesson->absences;
                $wasPresent = $this->wasPresent($absences, $lesson->reference, $enrollment->id, $enrollment->startAt);
                $data[$enrollment->name][]  = $wasPresent;
                if(!$wasPresent)
                    $totalAbsences++;
            }
            $totals[$enrollment->name]  = $totalAbsences;
        }

        return view(
            'reports/assessmentReport',
            [
                'title' => 'Relatório de Frequência',
                'data' => $data,
                'totals' => $totals,
                'references' => $references,
                'header' => $header
            ]
        );
    }

    private function wasPresent($absences, $reference, $enrollmentId, $startAt) {
        $reference = new DateTime($reference);
        $startAt = new DateTime($startAt);

        if($reference < $startAt)
            return '-';

        $present = true;

        foreach($absences as $absence) {
            if($absence->enrollment_id == $enrollmentId)
                return false;
        }

        return $present;
    }

    public function lessonsReport($classId, $packModuleSubjectId) {
        $lessonModel = new Lesson();

        $lessons = $lessonModel
        ->where("class_id", $classId)
        ->where("pack_module_subject_id", $packModuleSubjectId)
        ->orderBy("reference")
        ->get();

        $header = $this->genHeader($classId, $packModuleSubjectId, $lessons);

        $data = [];

        foreach($lessons as $lesson) {
            $obj = new stdClass();

            $obj->date = date_format(date_create($lesson->reference), 'd/m/Y');
            $obj->content = $lesson->content;

            $data[] = $obj;
        }

        return view(
            'reports/lessonsReport',
            [
                'title' => 'Relatório de Aulas Lecionadas',
                'header' => $header,
                'data' => $data
            ]
        );
    }

    private function genHeader($classId, $packModuleSubjectId, $lessons = []) {
        $classModel = new CClass();
        $subjectModel = new PackModuleSubject();

        $class = $classModel->with("pack.course")->find($classId);
        $packModuleSubject = $subjectModel->find($packModuleSubjectId);

        $header = new stdClass();
        $header->courseName = $class->pack->course->name;
        $header->className = $class->id." - ".$class->name;
        $header->subjectName = $packModuleSubject->subject->name;

        if(count($lessons) > 0)
            $header->period = 'De '.date_format(date_create($lessons[0]->reference), 'd/m/Y').' a '.date_format(date_create($lessons[count($lessons)-1]->reference), 'd/m/Y');

        return $header;
    }
}
