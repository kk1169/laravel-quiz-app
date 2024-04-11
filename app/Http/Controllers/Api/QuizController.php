<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quiz = Quiz::all();
        return ApiResponse::success($quiz, "", Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "title" => "required",
            "author_id" => "required"
        ]);

        if ($validate->passes()) {
            $quiz = new Quiz();
            $quiz->title = $request->title;
            $quiz->author_id = $request->author_id;
            $quiz->duration = $request->duration;
            $quiz->description = $request->description;
            $quiz->save();

            return ApiResponse::success($quiz, config('messages.quiz.created'), Response::HTTP_CREATED);
        }
        return ApiResponse::error($validate->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        return ApiResponse::success($quiz, '', Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validate = Validator::make($request->all(), [
            "title" => "required",
            "author_id" => "required"
        ]);

        if ($validate->passes()) {
            $quiz->title = $request->title;
            $quiz->author_id = $request->author_id;
            $quiz->duration = $request->duration;
            $quiz->description = $request->description;
            $quiz->save();

            return ApiResponse::success($quiz, config('messages.quiz.updated'), Response::HTTP_CREATED);
        }
        return ApiResponse::error($validate->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return ApiResponse::success($quiz, config('messages.quiz.deleted'), Response::HTTP_CREATED);
    }
}
