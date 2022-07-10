<?php

namespace App\Http\Controllers;

use App\Services\CClass\CClassDeleteService;
use App\Services\CClass\CClassGetService;
use App\Services\CClass\CClassPostService;
use App\Services\CClass\CClassPutService;
use Illuminate\Http\Request;

class CClassController extends Controller
{

    private $defaultRelationships = ['pack'];

     /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service = new CClassGetService();
        $service->setRelationships($this->defaultRelationships);
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
        $service = new CClassPostService();
        $service->setRelationships($this->defaultRelationships);
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
        $service = new CClassGetService();
        $service->setRelationships($this->defaultRelationships);
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
        $service = new CClassPutService();
        $service->setRelationships($this->defaultRelationships);
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
        $service = new CClassDeleteService();
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}
