<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends BaseController
{
    public function save(Request $request) {
        try {

            // validation
            $validation = Validator::make($request->all(), [
                'title' => 'required',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            if ($request->user()->tokenCan('quiz-crud')) {
                if ($request->id) {
                    $quiz = Quiz::find($request->id);
                }else {
                    $quiz = new Quiz();
                    $quiz->uri = Str::random(10);
                }

                $quiz->title = $request->title;
                $quiz->is_random = $request->is_random ? 1 : 0;

                if ($request->course_id) {
                    $quiz->course_id = $request->course_id;
                }else {
                    $course = Course::first();
                    $quiz->course_id = $course->id;
                }

                if ($request->start_at) {
                    $quiz->start_at = $request->start_at;
                    $quiz->is_notify = $request->is_notify ? 1 : 0;

                    if ($request->duration) {
                        $quiz->duration = $request->duration;
                    }else {
                        $quiz->duration = 30;
                    }
                }

                if ($request->nagative_point) {
                    $quiz->nagative_point = $request->nagative_point;
                }

                if ($request->hasFile('certi_stamp')) {
                    $quiz->certi_stamp = $this->upload('stamp', 'certi_stamp');
                }
                if ($request->hasFile('certi_signature')) {
                    $quiz->certi_signature = $this->upload('stamp', 'certi_signature');
                }
                $quiz->save();
                
                return $this->sendSuccess($quiz, "Quiz Created Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }
}
