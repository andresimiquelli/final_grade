<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Report\ReportService;

class ReportController extends Controller
{
    /**
     * Generate attendance report
     *
     * @param  int  $classId
     * @param  int  $packModuleSubjectId
     */
    public function attendance($classId, $packModuleSubjectId) {
        $reportService = new ReportService();
        return $reportService->attendanceReport($classId, $packModuleSubjectId);
    }

    /**
     * Generate attendance report
     *
     * @param  int  $classId
     * @param  int  $packModuleSubjectId
     */
    public function lessons($classId, $packModuleSubjectId) {
        $reportService = new ReportService();
        return $reportService->lessonsReport($classId, $packModuleSubjectId);
    }
}
