<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizInput;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class QuizController extends BaseController
{
    public function save(Request $request)
    {
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
                } else {
                    $quiz = new Quiz();
                    $quiz->uri = Str::random(10);
                }

                $quiz->title = $request->title;
                $quiz->is_random = $request->is_random ? 1 : 0;
                $quiz->user_id = auth()->user()->id;

                if ($request->course_id) {
                    $quiz->course_id = $request->course_id;
                } else {
                    $course = Course::first();
                    $quiz->course_id = $course->id;
                }

                $quiz->is_notify = $request->is_notify ? 1 : 0;
                if ($request->start_at) {
                    $quiz->start_at = Carbon::parse($request->start_at);

                    if (!is_null($request->duration)) {
                        $quiz->duration = $request->duration;
                    } else {
                        $quiz->duration = 30;
                    }
                } else {
                    $quiz->start_at = null;
                }

                if ($request->nagative_point) {
                    $quiz->nagative_point = $request->nagative_point;
                } else {
                    $quiz->nagative_point = 0;
                }

                // if ($request->hasFile('certi_stamp')) {
                //     $quiz->certi_stamp = $this->upload('stamp', 'certi_stamp');
                // }
                if ($request->hasFile('certi_signature')) {
                    $quiz->certi_signature = $this->upload('stamp', 'certi_signature');
                } else {
                    $quiz->certi_signature = null;
                }
                $quiz->save();

                if (!$request->id) {
                    $this->_create_default_question($quiz->id);
                }

                return $this->sendSuccess($quiz, "Quiz Created Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), 500);
            // return $this->sendError("Internal Server Error", 500);
        }
    }

    public function _create_default_question($quiz_id)
    {
        try {
            $que = new Question();
            $que->quiz_id = $quiz_id;
            $que->title = 'Multiple Choice Question';
            $que->type = 'options';
            $que->stand_index = 0;
            $que->save();

            $this->_create_default_input($quiz_id, $que->id);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function _create_default_input($quiz_id, $que_id)
    {
        try {
            $inputs = new QuizInput();
            $inputs->question_id = $que_id;
            $inputs->quiz_id = $quiz_id;
            $inputs->name = 'Option';
            $inputs->save();
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function remove(Request $request, $id)
    {
        try {
            if ($request->user()->tokenCan('quiz-crud')) {
                Quiz::find($id)->delete();
                Question::where('quiz_id', $id)->delete();
                QuizInput::where('quiz_id', $id)->delete();

                return $this->sendSuccess([], "Quiz Remove Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function addQue(Request $request)
    {
        try {
            // validation
            $validation = Validator::make($request->all(), [
                'quiz_id' => 'required',
                'title' => 'required',
                'type' => 'required',
                'stand_index' => 'required',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            if ($request->user()->tokenCan('quiz-crud')) {
                if ($request->id) {
                    $que = Question::find($request->id);
                } else {
                    $que = new Question();
                }

                $que->quiz_id = $request->quiz_id;
                $que->title = $request->title;
                $que->type = $request->type;
                $que->point = $request->point ? $request->point : 1;
                $que->is_required = $request->is_required ? 1 : 0;
                $que->stand_index = $request->stand_index;

                if ($request->hasFile('img')) {
                    $que->img = $this->upload('question', 'img');
                } else {
                    $que->img = null;
                }

                $que->save();

                if (!$request->id) {
                    $this->_create_default_input($request->quiz_id, $que->id);
                }

                $responceQue = Question::with('inputs')->find($que->id);
                return $this->sendSuccess($responceQue, "Question Added Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            // return $this->sendError("Internal Server Error", 500);
            return $this->sendError($th->getMessage(), 500);
        }
    }

    public function removeQue(Request $request, $id)
    {
        try {
            if ($request->user()->tokenCan('quiz-crud')) {
                Question::find($id)->delete();
                QuizInput::where('question_id', $id)->delete();

                return $this->sendSuccess([], "Question Remove Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function addInput(Request $request)
    {
        try {
            // validation
            $validation = Validator::make($request->all(), [
                'quiz_id' => 'required',
                'question_id' => 'required',
                'name' => 'required',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            if ($request->user()->tokenCan('quiz-crud')) {
                if ($request->id) {
                    $inputs = QuizInput::find($request->id);
                } else {
                    $inputs = new QuizInput();
                }

                $inputs->quiz_id = $request->quiz_id;
                $inputs->question_id = $request->question_id;
                $inputs->name = $request->name;
                $inputs->is_answer = $request->is_answer ? 1 : 0;

                $inputs->save();
                return $this->sendSuccess($inputs, "Input Added Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function removeInput(Request $request, $id)
    {
        try {
            if ($request->user()->tokenCan('quiz-crud')) {
                QuizInput::find($id)->delete();

                return $this->sendSuccess([], "Question Input Remove Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function fetchSingle(Request $request, $id)
    {
        try {
            if ($request->user()->tokenCan('quiz-crud')) {
                $quiz = Quiz::with(['questions' => function ($q) {
                    return $q->orderBy('stand_index');
                }, 'course'])->find($id);
                if ($quiz) {
                    return $this->sendSuccess($quiz, "Quiz Fetch Successfully");
                }
                return $this->sendError("Not Found", 404);
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function get()
    {
        try {
            $quiz = Quiz::with(['questions' => function ($q) {
                return $q->orderBy('stand_index');
            }, 'user', 'course'])->orderBy('updated_at', 'desc')->paginate(10);
            return $this->sendSuccess($quiz, "Quiz Fetch Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function getSearch(Request $request)
    {
        try {

            $quiz = Quiz::with(['questions' => function ($q) {
                return $q->orderBy('stand_index');
            }, 'user', 'course'])->orderBy('updated_at', 'desc')->where('title', 'like', '%' . $request->search . '%')->paginate(10);
            return $this->sendSuccess($quiz, "Quiz Fetch Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function fetchTest(Request $request, $uri)
    {
        try {
            $quiz = Quiz::with(['questions' => function ($q) {
                return $q->orderBy('stand_index');
            }, 'course'])->where('uri',$uri)->first();

            $isStartDate = Carbon::parse($quiz->start_at);
            $isEndDate = Carbon::parse($quiz->start_at)->addMinute($quiz->duration);
            $now = Carbon::parse(Carbon::now()->timezone('Asia/Kolkata')->toDateTimeLocalString());
            $isDateBetween = $now >= $isStartDate && $now <= $isEndDate;

            if ($quiz->start_at && !$isDateBetween && auth()->user()->role_id == 2) {
                if ($now < $isStartDate) {
                    return $this->sendError("Quiz is in pending", 202);
                }
                return $this->sendError("Quiz is dead", 201);
            }

            if ($quiz) {
                return $this->sendSuccess($quiz, "Quiz Fetch Successfully");
            }
        } catch (\Throwable $th) {
            // return $this->sendError("Internal Server Error", 500);
            return $this->sendError($th->getMessage(), 500);
        }
    }
}
