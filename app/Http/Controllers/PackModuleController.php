<?php

namespace App\Http\Controllers;

use App\Services\Pack\Module\PackModuleDeleteService;
use App\Services\Pack\Module\PackModuleGetService;
use App\Services\Pack\Module\PackModulePostService;
use App\Services\Pack\Module\PackModulePutService;
use Illuminate\Http\Request;

class PackModuleController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $pack
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $pack_id)
    {
        $service = new PackModuleGetService(['pack_id' => $pack_id]);

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
    public function store(Request $request, $pack_id)
    {
        $service = new PackModulePostService(['pack_id' => $pack_id]);
        $result = $service->create($request->json()->all());

        return response()->json($result,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $pack_id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $pack_id)
    {
        $service = new PackModuleGetService(['pack_id' => $pack_id]);
        $result = $service->find($id);

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pack_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pack_id, $id)
    {
        $service = new PackModulePutService(['pack_id' => $pack_id]);
        $result = $service->update($id, $request->json()->all());

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $pack_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pack_id, $id)
    {
        $service = new PackModuleDeleteService(['pack_id' => $pack_id]);
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}