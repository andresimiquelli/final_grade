<?php

namespace App\Http\Controllers;

use App\Services\Teacher\Assignment\TeacherAssignmentDeleteService;
use App\Services\Teacher\Assignment\TeacherAssignmentGetService;
use App\Services\Teacher\Assignment\TeacherAssignmentPostService;
use App\Services\Teacher\Assignment\TeacherAssignmentPutService;
use Illuminate\Http\Request;

class TeacherAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $pack
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $teacher_id)
    {
        $service = new TeacherAssignmentGetService(['teacher_id' => $teacher_id]);

        if($request->has('with'))
            $service->setRelationships(explode(',',$request->get('with')));

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
    public function store(Request $request, $teacher_id)
    {
        $service = new TeacherAssignmentPostService(['teacher_id' => $teacher_id]);
        $result = $service->create($request->json()->all());

        return response()->json($result,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $teacher_id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $teacher_id)
    {
        $service = new TeacherAssignmentGetService(['teacher_id' => $teacher_id]);

        if($request->has('with'))
            $service->setRelationships(explode(',',$request->get('with')));

        $result = $service->find($id);

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $teacher_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teacher_id, $id)
    {
        $service = new TeacherAssignmentPutService(['teacher_id' => $teacher_id]);
        $result = $service->update($id, $request->json()->all());

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $teacher_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher_id, $id)
    {
        $service = new TeacherAssignmentDeleteService(['teacher_id' => $teacher_id]);
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}
