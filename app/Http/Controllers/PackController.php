<?php

namespace App\Http\Controllers;

use App\Services\Pack\PackDeleteService;
use App\Services\Pack\PackGetService;
use App\Services\Pack\PackPostService;
use App\Services\Pack\PackPutService;
use Illuminate\Http\Request;

class PackController extends Controller
{

    private $defaultRelationships = ['course'];

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service = new PackGetService();
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
        $service = new PackPostService();
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
        $service = new PackGetService();
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
        $service = new PackPutService();
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
        $service = new PackDeleteService();
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}
