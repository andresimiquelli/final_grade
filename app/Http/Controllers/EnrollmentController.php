<?php

namespace App\Http\Controllers;

use App\Services\Enrollment\EnrollmentDeleteService;
use App\Services\Enrollment\EnrollmentGetService;
use App\Services\Enrollment\EnrollmentPostService;
use App\Services\Enrollment\EnrollmentPutService;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service = new EnrollmentGetService();

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
    public function store(Request $request)
    {
        $service = new EnrollmentPostService();
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
        $service = new EnrollmentGetService();

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
    public function update(Request $request, $id)
    {
        $service = new EnrollmentPutService();
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
        $service = new EnrollmentDeleteService();
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}
