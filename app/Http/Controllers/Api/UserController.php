<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return ApiResponse::success($user, "", Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "role" => "required"
        ]);

        if ($validate->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = $request->role;
            $user->save();

            return ApiResponse::success($user, config('messages.user.created'), Response::HTTP_CREATED);
        }
        return ApiResponse::error($validate->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return ApiResponse::success($user, "", Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "role" => "required"
        ]);

        if ($validate->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = $request->role;
            $user->save();

            // $user = $user->update($request->all());
            return ApiResponse::success($user, config('messages.user.updated'), Response::HTTP_CREATED);
        }
        return ApiResponse::error($validate->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return ApiResponse::success($user, config('messages.user.delete'), Response::HTTP_CREATED);
    }
}
