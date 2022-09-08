<?php

namespace App\Http\Controllers;

use App\Exceptions\DataValidationException;
use App\Exceptions\Error;
use App\Services\Finalgrade\FinalgradeDeleteService;
use App\Services\Finalgrade\FinalgradeGetService;
use App\Services\Finalgrade\FinalgradePostManyService;
use App\Services\Finalgrade\FinalgradePostService;
use App\Services\Finalgrade\FinalgradePutService;
use App\Services\Finalgrade\FinalGradeReportService;
use App\Services\Journal\JournalPostService;
use Illuminate\Http\Request;

class FinalgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $needed = $this->getNeeded($request);
        $service = new FinalgradeGetService($needed);

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
    public function store(Request $request)
    {
        $service = new FinalgradePostService();
        $result = $service->create($request->json()->all());

        return response()->json($result,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = new FinalgradeGetService();
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
    public function update(Request $request, $id)
    {
        $service = new FinalgradePutService();
        $result = $service->update($id, $request->json()->all());

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = new FinalgradeDeleteService();
        $result = $service->delete($id);

        return response()->json($result);
    }

    /**
     * Get shutdown report
     *
     * @param int $class_id
     * @param int $subject_id
     * @return \Illuminate\Http\Response
     */
    public function report($class_id, $subject_id)
    {
        $service = new FinalGradeReportService();
        $result = $service->report($class_id,$subject_id);
        return response($result);
    }

    /**
     * Post shutdown report
     *
     * @param int $class_id
     * @param int $subject_id
     * @return \Illuminate\Http\Response
     */
    public function storeAll(Request $request, $class_id, $subject_id)
    {
        $result = [];
        $service = new FinalgradePostManyService();

        if($request->has('grades'))
        {
            $grades = $request->json()->get('grades');
            if(is_array($grades))
            {
                $result = $service->saveAll($grades);
                $journalService = new JournalPostService();
                $journalService->createOrUpdate([
                    'class_id' => $class_id,
                    'pack_module_subject_id' => $subject_id,
                    'status' => 1
                ]);
            }
        }

        return response()->json($result, 201);
    }

    private function getNeeded($request)
    {
        $needed = [];

        if($request->has('enrollment_id'))
            $needed['enrollment_id'] = $request->get('enrollment_id');

        if($request->has('subject_id'))
            $needed['subject_id'] = $request->get('subject_id');

        if(count($needed) == 0)
            throw new DataValidationException(['needed' => 'enrollment_id or subject_id are needed.']);

        return $needed;
    }
}
