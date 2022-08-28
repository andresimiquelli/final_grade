<?php

namespace App\Http\Controllers;

use App\Services\User\Assignment\UserAssignmentDeleteService;
use App\Services\User\Assignment\UserAssignmentGetService;
use App\Services\User\Assignment\UserAssignmentPostService;
use App\Services\User\Assignment\UserAssignmentPutService;
use Illuminate\Http\Request;

class UserAssignmentController extends Controller
{

    private $defaultRelationships = ['cclass','subject.subject'];

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $pack
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        $service = new UserAssignmentGetService(['user_id' => $user_id]);

        if($request->has('with'))
            $service->setRelationships(explode(',',$request->get('with')));
        else
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
    public function store(Request $request, $user_id)
    {
        $service = new UserAssignmentPostService(['user_id' => $user_id]);
        $service->setRelationships($this->defaultRelationships);
        $result = $service->create($request->json()->all());

        return response()->json($result,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $user_id)
    {
        $service = new UserAssignmentGetService(['user_id' => $user_id]);

        if($request->has('with'))
            $service->setRelationships(explode(',',$request->get('with')));
        else
            $service->setRelationships($this->defaultRelationships);

        $result = $service->find($id);

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $id)
    {
        $service = new UserAssignmentPutService(['user_id' => $user_id]);
        $service->setRelationships($this->defaultRelationships);
        $result = $service->update($id, $request->json()->all());

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $user_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        $service = new UserAssignmentDeleteService(['user_id' => $user_id]);
        $result = $service->delete($id);
        
        return response()->json($result);
    }
}
