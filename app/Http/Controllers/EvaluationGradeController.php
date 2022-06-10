<?php

namespace App\Http\Controllers;

use App\Services\Evaluation\Grade\EvaluationGradeDeleteService;
use App\Services\Evaluation\Grade\EvaluationGradeGetService;
use App\Services\Evaluation\Grade\EvaluationGradePostService;
use App\Services\Evaluation\Grade\EvaluationGradePutService;
use Illuminate\Http\Request;

class EvaluationGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $class_id, $subject_id, $evaluation_id)
    {
        $service = new EvaluationGradeGetService(['evaluation_id' => $evaluation_id]);
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
    public function store(Request $request, $class_id, $subject_id, $evaluation_id)
    {
        $service = new EvaluationGradePostService(['evaluation_id' => $evaluation_id]);
        $result = $service->create($request->json()->all());

        return response()->json($result,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($class_id, $subject_id, $evaluation_id, $id)
    {

        $service = new EvaluationGradeGetService(['evaluation_id' => $evaluation_id]);
        $result = $service->find($id);

        return response()->json($result);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($class_id, $subject_id, $evaluation_id, $id)
    {
        $service = new EvaluationGradeDeleteService(['evaluation_id' => $evaluation_id]);
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}
