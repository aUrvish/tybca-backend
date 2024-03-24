<?php

namespace App\Http\Controllers;

use App\Events\NoticePublish;
use App\Models\Course;
use App\Models\Entrie;
use App\Models\Notice;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizInput;
use App\Models\Responce;
use App\Models\Result;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

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
                if ($request->is_random == 'true' || $request->is_random == 1) {
                    $quiz->is_random = 1;
                }else {
                    $quiz->is_random = 0;
                }

                if ($request->is_notify == 'true' || $request->is_notify == 1) {
                    $quiz->is_notify = 1;

                    $notice = Notice::where('quiz_id', $quiz->id)->first();

                    if (!$notice) {
                        $notice = new Notice();
                        $notice->quiz_id = $quiz->id;
                    }

                    $notice->user_id = auth()->user()->id;

                    $course = Course::find($quiz->course_id);
                    $title = $course->name . " MCQ Exam Notice";
                    $notice->title = $title;
                    $notice->caption = $title;
                    $notice->uri = Str::random(10);
                    $notice->textarea = $this->_quiz_notification($title, $quiz->start_at ? $quiz->start_at : 'Now' , $quiz->duration);
                    $notice->publish_at = Carbon::now();
                    $notice->status = 1;
                    $notice->save();
                    event(new NoticePublish());
                }else {
                    $quiz->is_notify = 0;
                }

                $quiz->user_id = auth()->user()->id;

                if ($request->course_id) {
                    $quiz->course_id = $request->course_id;
                } else {
                    $course = Course::first();
                    $quiz->course_id = $course->id;
                }

                if ($request->start_at != 'null' && $request->start_at) {
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
                }else {
                    $quiz->certi_signature = $request->certi_signature;
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
                $que->is_required = ($request->is_required && $request->is_required != 'false') ? 1 : 0;
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
            return $this->sendError("Internal Server Error", 500);
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
            $quiz = Quiz::with(['questions', 'user', 'course'])->orderBy('updated_at', 'desc')->orderBy('updated_at', 'desc')->paginate(10);
            return $this->sendSuccess($quiz, "Quiz Fetch Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function test()
    {
        try {
            $quiz = Quiz::with(['questions', 'user', 'course'])->orderBy('updated_at', 'desc')->get();
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
            $quiz = Quiz::where('uri',$uri)->first();

            $entrie = Entrie::where('quiz_id' , $quiz->id)->where('user_id' , auth()->user()->id)->first();

            if (auth()->user()->role_id == 2 && $entrie) {
                return $this->sendSuccess([],"Already Responded", 205);
            }

            $isStartDate = Carbon::parse($quiz->start_at);
            $isEndDate = Carbon::parse($quiz->start_at)->addMinute($quiz->duration);
            $now = Carbon::parse(Carbon::now()->timezone('Asia/Kolkata')->toDateTimeLocalString());
            $isDateBetween = $now >= $isStartDate && $now <= $isEndDate;

            if ($quiz->start_at && !$isDateBetween && auth()->user()->role_id == 2) {
                if ($now < $isStartDate) {
                    return $this->sendSuccess(['start_at' =>  $quiz->start_at] ,"Quiz is in pending", 202);
                }
                return $this->sendSuccess([],"Quiz is dead", 201);
            }

            if ($quiz->is_random) {
                $responceQuiz = Quiz::where('uri',$uri)->with(['questions' => function ($q) {
                    return $q->inRandomOrder();
                }, 'course'])->first();
            }else {
                $responceQuiz = Quiz::where('uri',$uri)->with(['questions' => function ($q) {
                    return $q->orderBy('stand_index');
                }, 'course'])->first();
            }

            if ($quiz) {
                return $this->sendSuccess($responceQuiz, "Quiz Fetch Successfully");
            }
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function saveResponce(Request $request)
    {
        try {
            $quiz = Quiz::find($request->quiz_id);
            $isStartDate = Carbon::parse($quiz->start_at);
            $isEndDate = Carbon::parse($quiz->start_at)->addMinute($quiz->duration);
            $now = Carbon::parse(Carbon::now()->timezone('Asia/Kolkata')->toDateTimeLocalString());
            $isDateBetween = $now >= $isStartDate && $now <= $isEndDate;

            if ($quiz->start_at && !$isDateBetween && auth()->user()->role_id == 2) {
                if ($now < $isStartDate) {
                    return $this->sendError("Quiz is in pending", 202);
                }
                return $this->sendError("Quiz is dead", 404);
            }

            $entrie = new Entrie();
            $entrie->user_id = auth()->user()->id;
            $entrie->quiz_id = $request->quiz_id;

            if (auth()->user()->role_id == 2) {
                $entrie->save();
            }

            if ($entrie->id) {
                foreach($request->responce as $responce ){
                    $res = new Responce();
                    $res->entries_id = $entrie->id;
                    $res->que_id = $responce['que_id'];
                    $res->option_id = $responce['option_id'];
                    $res->save();
                }

                if(auth()->user()->role_id == 2){
                    $result = $this->_calculate_score($entrie->id, $quiz->course_id);
                }

            }


            return $this->sendSuccess(isset($result) ? $result : [], "Responce Save Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function getResponce(Request $request,$quiz_id)
    {
        try {
            if ($request->user()->tokenCan('quiz-crud')) { 
                $entrie = Entrie::where('quiz_id', $quiz_id)->orderBy('created_at', 'desc')->with('user')->paginate();
                return $this->sendSuccess($entrie, "Responce Fetch Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }
    
    public function getSingleResponce(Request $request,$id)
    {
        try {
            if ($request->user()->tokenCan('quiz-crud')) { 
                $responce = Responce::where('entries_id', $id)->with(['question', 'input'])->get();
                return $this->sendSuccess($responce, "Responce Fetch Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function removeResponce(Request $request,$id)
    {
        try {
            if ($request->user()->tokenCan('quiz-crud')) { 
                Entrie::find($id)->delete();
                Responce::where('entries_id',$id)->delete();
                return $this->sendSuccess([], "Responce Delete Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function _quiz_notification ($quizTitle, $time, $duration) {
        return '<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h2 style="text-align: center;">'.$quizTitle.'</h2>
        <p><strong>Date:</strong>'.$time.'</p>
        <p><strong>Platform:</strong> Ventures </p>
        <p><strong>Instructions:</strong></p>
        <ol>
            <li>The exam will consist of multiple-choice questions (MCQs) related to data science.</li>
            <li>Ensure you have a stable internet connection and a quiet environment for the exam.</li>
            <li>Login to the Ventures platform using your credentials '.$duration.' minutes before the exam starts.</li>
            <li>Follow the instructions provided by the exam proctor during the exam.</li>
            <li>Complete the exam within the specified time limit.</li>
            <li>Contact the support team immediately in case of any technical issues during the exam.</li>
        </ol>
        <p><strong>Note:</strong> Make sure to review all the necessary materials and be prepared for the exam.</p>
    </div>
    
    </body>';
    }

    public function _calculate_score ($entrie_id = 1 , $course_id = 1) {
        try {
            $entrie = collect(Entrie::with(['user', 'responce'])->find($entrie_id));
            $sum = 0;
            $total = 0;
            foreach($entrie['responce'] as $responce ){
                $total += $responce['question']['point'];

                if($responce['input']['is_answer']) {
                    $sum += $responce['question']['point'];
                }
            }

            $course = Course::find($course_id);

            // set in database
            $quizResult = new Result();
            $quizResult->quiz_id = $entrie['quiz_id'];
            $quizResult->user_id = $entrie['user']['id'];
            $quizResult->cource_id = $course_id;
            $quizResult->score = $sum;
            $quizResult->max = $total;
            $quizResult->is_pass = $total ? (($sum * 100 / $total) <= 33 ? 0 : 1) : 0;
            $quizResult->save();
            
            return [
                'user' => $entrie['user'],
                'score' => $sum,
                'total' => $total,
                'percentage' => $total ? ($sum * 100 / $total) : 0,
                'course' => $course->name,
            ];

        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function getResult() { 

        try {            
            $result = Result::with('course', 'user', 'quiz')->where('user_id', auth()->user()->id)->get();
            $data = $result->filter( function($curr) {
                return $curr['max'] != 0 ? ($curr['score'] * 100 / $curr['max'] < 33 ? false : true) : false;
            })->values();

            return $this->sendSuccess($data, "Responce Fetch Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    } 

    public function getUserResult($id) { 

        try {            
            $result = Result::with('course', 'user', 'quiz')->where('user_id', $id)->get();
            $data = $result->filter( function($curr) {
                return $curr['max'] != 0 ? ($curr['score'] * 100 / $curr['max'] < 33 ? false : true) : false;
            })->values();

            return $this->sendSuccess($data, "Responce Fetch Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    } 
}
