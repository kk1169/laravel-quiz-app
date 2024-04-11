<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $option = Option::all();
        return ApiResponse::success($option, "", Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "title" => "required",
            "question_id" => "required"
        ]);

        if ($validate->passes()) {
            $option = new Option();
            $option->title = $request->title;
            $option->question_id = $request->question_id;
            $option->correct = $request->correct;
            $option->status = $request->status;
            $option->save();

            return ApiResponse::success($option, config('messages.option.created'), Response::HTTP_CREATED);
        }
        return ApiResponse::error($validate->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        return ApiResponse::success($option, '', Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        $validate = Validator::make($request->all(), [
            "title" => "required",
            "question_id" => "required"
        ]);

        if ($validate->passes()) {
            $option->title = $request->title;
            $option->question_id = $request->question_id;
            $option->correct = $request->correct;
            $option->status = $request->status;
            $option->save();

            return ApiResponse::success($option, config('messages.option.updated'), Response::HTTP_CREATED);
        }
        return ApiResponse::error($validate->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return ApiResponse::success($option, config('messages.option.deleted'), Response::HTTP_CREATED);
    }
}
