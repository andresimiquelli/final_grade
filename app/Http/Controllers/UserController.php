<?php

namespace App\Http\Controllers;

use App\Exceptions\DataValidationException;
use App\Services\User\UserChangePasswordService;
use App\Services\User\UserDeleteService;
use App\Services\User\UserGetService;
use App\Services\User\UserPostService;
use App\Services\User\UserPutService;
use App\Services\User\UserResetPasswordService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service = new UserGetService();
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
        $service = new UserPostService();
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
        $service = new UserGetService();
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
        $service = new UserPutService();
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
        $service = new UserDeleteService();
        $result = $service->delete($id);

        return response()->json($result);
    }

    /**
     * Change password
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, $id)
    {
        $service = new UserChangePasswordService();
        $result = $service->change($id, $request->json()->all());

        return response()->json($result);
    }

    /**
     * Change password
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        if($request->json()->has('email')) {
            $email = $request->json()->get('email');
            $service = new UserResetPasswordService();

            if($service->reset($email)) {
                return response()->json(["success"]);
            }
        }

        throw new DataValidationException(['email' => 'Email is required']);
    }
}
