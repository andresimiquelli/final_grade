<?php

namespace App\Http\Controllers;

use App\Exceptions\DataValidationException;
use App\Exceptions\ResourceNotFoundException;
use App\Services\Evaluation\Grade\EvaluationGradeDeleteService;
use App\Services\Evaluation\Grade\EvaluationGradeGetService;
use App\Services\Evaluation\Grade\EvaluationGradePostService;
use Exception;
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
        $service->setPaginate(false);

        if($request->has("with"))
            $service->setRelationships(explode(',', $request->get('with')));

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

    public function saveAll(Request $request, $evaluation_id) 
    {
        $getService = new EvaluationGradeGetService(['evaluation_id' => $evaluation_id]);
        $postService = new EvaluationGradePostService(['evaluation_id' => $evaluation_id]);

        $response['success'] = [];
        $response['fail'] = [];

        if($request->json()->has('grades'))
        {
            $grades = $request->json()->get('grades');
            if(is_array(($grades)))
            {
                foreach($grades as $grade) {

                    $enrollment_id = $grade['enrollment_id'];
                    $value = intval($grade['value']);

                    try 
                    {
                        $exists = $getService->findBy('enrollment_id', $enrollment_id);
                        
                        if($value < 0)
                        {                            
                            $exists->destroy($exists->id);
                        }
                        else 
                        {
                            if(!$exists->value == $value) {
                                $exists->value = $value;
                                $exists->save();
                            }
                            
                            $response['success'][] = $grade;
                        }
                        
                    }
                    catch(ResourceNotFoundException $e)
                    {
                        if($value > 0)
                        {
                            $postService->create($grade);
                            $response['success'][] = $grade;
                        }                        
                    }
                    catch(Exception $e) 
                    {
                        array_push($response['fail'], ['grade' => $grade, 'message' => $e->getMessage()]);
                    }                    
                }

                return response()->json($response);
            }
        }

        throw new DataValidationException(['grades' => 'grades are required']);
    }
}
