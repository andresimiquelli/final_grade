<?php

namespace App\Http\Controllers;

use App\Services\Lesson\LessonDeleteService;
use App\Services\Lesson\LessonGetService;
use App\Services\Lesson\LessonPostService;
use App\Services\Lesson\LessonPutService;
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
    public function show($class_id, $subject_id, $id)
    {
        $service = new LessonGetService(['class_id' => $class_id, 'pack_module_subject_id' => $subject_id]);
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
}
