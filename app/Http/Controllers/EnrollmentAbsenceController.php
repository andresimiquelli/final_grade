<?php

namespace App\Http\Controllers;

use App\Services\Enrollment\Absence\EnrollmentAbsenceDeleteService;
use App\Services\Enrollment\Absence\EnrollmentAbsenceGetService;
use App\Services\Enrollment\Absence\EnrollmentAbsencePostService;
use App\Services\Enrollment\Absence\EnrollmentAbsencePutService;
use Illuminate\Http\Request;

class EnrollmentAbsenceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $enrollment
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $enrollment_id)
    {
        $service = new EnrollmentAbsenceGetService(['enrollment_id' => $enrollment_id]);

        if($request->has('filters'))
            $result = $service->search($request->get('filters'));
        else
            $result = $service->findAll();
        
       return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $enrollment_id)
    {
        $service = new EnrollmentAbsencePostService(['enrollment_id' => $enrollment_id]);
        $result = $service->create($request->json()->all());

        return response()->json($result,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $enrollment_id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $enrollment_id)
    {
        $service = new EnrollmentAbsenceGetService(['enrollment_id' => $enrollment_id]);
        $result = $service->find($id);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $enrollment_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($enrollment_id, $id)
    {
        $service = new EnrollmentAbsenceDeleteService(['enrollment_id' => $enrollment_id]);
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}
