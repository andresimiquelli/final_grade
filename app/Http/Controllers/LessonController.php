<?php

namespace App\Http\Controllers;

use App\Services\Enrollment\Absence\EnrollmentAbsenceDeleteService;
use App\Services\Enrollment\Absence\EnrollmentAbsencePostService;
use App\Services\Lesson\LessonDeleteService;
use App\Services\Lesson\LessonGetService;
use App\Services\Lesson\LessonPostService;
use App\Services\Lesson\LessonPutService;
use Exception;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $class_id, $subject_id)
    {
        $service = new LessonGetService(['class_id' => $class_id, 'pack_module_subject_id' => $subject_id]);

        if($request->has("with"))
            $service->setRelationships(explode(",",$request->get("with")));

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
    public function store(Request $request, $class_id, $subject_id)
    {
        $service = new LessonPostService(['class_id' => $class_id, 'pack_module_subject_id' => $subject_id]);
        $result = $service->create($request->json()->all());

        return response()->json($result,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $class_id, $subject_id, $id)
    {
        $service = new LessonGetService(['class_id' => $class_id, 'pack_module_subject_id' => $subject_id]);

        if($request->has("with"))
            $service->setRelationships(explode(",",$request->get("with")));

        $result = $service->find($id);

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_id, $subject_id, $id)
    {
        $service = new LessonPutService(['class_id' => $class_id, 'pack_module_subject_id' => $subject_id]);
        $result = $service->update($id, $request->json()->all());

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($class_id, $subject_id, $id)
    {
        $service = new LessonDeleteService(['class_id' => $class_id, 'pack_module_subject_id' => $subject_id]);
        $result = $service->delete($id);
        
        return response()->json($result);
    }

    public function updateAbsences(Request $request, $lesson_id)
    {
        $postService = new EnrollmentAbsencePostService();
        $deleteService = new EnrollmentAbsenceDeleteService();

        $data = $request->json()->all();

        $result['delete']['success'] = [];
        $result['delete']['fail'] = [];
        $result['include']['success'] = [];
        $result['include']['fail'] = [];

        if(array_key_exists('delete', $data))
        {
            $toDelete = $data['delete'];
            if(is_array($toDelete)) {
                foreach($toDelete as $id) {
                    try {
                        $deleted = $deleteService->deleteByFields(['lesson_id' => $lesson_id, 'enrollment_id' => $id]);
                        $result['delete']['success'][] = $deleted[0]->enrollment_id;
                    } catch (Exception $e) {
                        $result['delete']['fail'][] = $id;
                    }
                }
            }
        }

        if(array_key_exists('include', $data))
        {
            $toInclude = $data['include'];
            if(is_array($toInclude)) {
                foreach($toInclude as $id) {
                    try {
                        $postService->create(['lesson_id' => $lesson_id, 'enrollment_id' => $id]);
                        $result['include']['success'][] = $id;
                    } catch (Exception $e) {
                        $result['include']['fail'][] = $id;
                    }
                }
            }
        }

        return response()->json($result);
    }
}
