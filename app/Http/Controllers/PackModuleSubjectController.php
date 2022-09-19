<?php

namespace App\Http\Controllers;

use App\Services\Pack\Module\Subject\PackModuleSubjectDeleteService;
use App\Services\Pack\Module\Subject\PackModuleSubjectGetService;
use App\Services\Pack\Module\Subject\PackModuleSubjectPostService;
use App\Services\Pack\Module\Subject\PackModuleSubjectPutService;
use App\Services\Pack\Module\Subject\PackModuleSubjectReorderService;
use Illuminate\Http\Request;

class PackModuleSubjectController extends Controller
{

    private $defaultRelationships = ['subject'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $pack_id, $module_id = null)
    {
        if(is_null($module_id))
            $service = new PackModuleSubjectGetService(['pack_id' => $pack_id]);
        else
            $service = new PackModuleSubjectGetService(['pack_module_id' => $module_id]);

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
    public function store(Request $request, $pack_id, $module_id)
    {
        $service = new PackModuleSubjectPostService(['pack_module_id' => $module_id]);
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
    public function show($id, $pack_id, $module_id)
    {
        $service = new PackModuleSubjectGetService(['pack_module_id' => $module_id]);
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
    public function update(Request $request, $pack_id, $module_id, $id)
    {
        $service = new PackModuleSubjectPutService(['pack_module_id' => $module_id]);
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
    public function destroy($pack_id, $module_id, $id)
    {

        $service = new PackModuleSubjectDeleteService(['pack_module_id' => $module_id]);
        $result = $service->delete($id);

        return response()->json($result);
    }

    public function reorder(Request $request)
    {
        $service = new PackModuleSubjectReorderService();
        $service->reorder($request->json()->get('ids'));
    }
}
