<?php

namespace App\Http\Controllers;

use App\Services\Student\StudentDeleteService;
use App\Services\Student\StudentGetService;
use App\Services\Student\StudentPostService;
use App\Services\Student\StudentPutService;
use Illuminate\Http\Request;

class StudetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service = new StudentGetService();
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
        $service = new StudentPostService();
        $result = $service->create($request->json()->all());

        return response()->json($result,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $service = new StudentGetService();
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
        $service = new StudentPutService();
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
        $service = new StudentDeleteService();
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}
