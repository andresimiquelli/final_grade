<?php

namespace App\Http\Controllers;

use App\Services\Course\CourseDeleteService;
use App\Services\Course\CourseGetService;
use App\Services\Course\CoursePostService;
use App\Services\Course\CoursePutService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courseGetService = new CourseGetService();

        if($request->has('filters'))
            $result = $courseGetService->search($request->get('filters'));
        else
            $result = $courseGetService->findAll();
        
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
        $coursePostService = new CoursePostService();
        $result = $coursePostService->create($request->json()->all());

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
        $courseGetService = new CourseGetService();
        $result = $courseGetService->find($id);

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
        $coursePutService = new CoursePutService();
        $result = $coursePutService->update($id, $request->json()->all());

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
        $courseDeleteService = new CourseDeleteService();
        $result = $courseDeleteService->delete($id);
        
        return response()->json($result);
    }
}
