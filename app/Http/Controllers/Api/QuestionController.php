<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $question = Question::all();
        return ApiResponse::success($question, '', Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "title" => "required",
            "quiz_id" => "required",
            "order" => "required",
            "duration" => "required"
        ]);

        if ($validate->passes()) {
            $question = new Question();
            $question->title = $request->title;
            $question->quiz_id = $request->quiz_id;
            $question->order = $request->order;
            $question->duration = $request->duration;
            $question->type = $request->type;
            $question->status = $request->status;
            $question->save();

            return ApiResponse::success($question, config('messages.question.created'), Response::HTTP_CREATED);
        }
        return ApiResponse::error($validate->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return ApiResponse::success($question, '', Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $validate = Validator::make($request->all(), [
            "title" => "required",
            "quiz_id" => "required",
            "order" => "required",
            "duration" => "required"
        ]);

        if ($validate->passes()) {
            $question->title = $request->title;
            $question->quiz_id = $request->quiz_id;
            $question->order = $request->order;
            $question->duration = $request->duration;
            $question->type = $request->type;
            $question->status = $request->status;
            $question->save();

            return ApiResponse::success($question, config('messages.question.updated'), Response::HTTP_CREATED);
        }
        return ApiResponse::error($validate->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return ApiResponse::success($question, config('messages.question.deleted'), Response::HTTP_CREATED);
    }
}
