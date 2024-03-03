<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    public function add(Request $request)
    {
        try {
            // validation
            $validation = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            if ($request->user()->tokenCan('course-crud')) {

                // check course already exist
                if (Course::where('name', $request->name)->first()) {
                    return $this->sendError("Course Aready exist", 409);
                }

                if ($request->id) {
                    $course = Course::find($request->id);
                    $course->primary_color = $course->primary_color;
                    $message = "Course Change Successfully";
                } else {
                    $course = new Course();
                    $color = ["#BD39FC", "#BD39FC", "#1F75F7", "#11CD0E", "#00BFFB", "#0AE1A1", "#FF9432"];
                    $getColor = $color[rand(0, count($color) - 1)];
                    $course->primary_color = $getColor;
                    $message = "Course Added Successfully";
                }

                $course->name = $request->name;
                $course->save();

                return $this->sendSuccess(Course::all(), $message);
            }

            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $data = Course::all();
            return $this->sendSuccess($data, "Courses Fetched Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function remove(Request $request, $id)
    {
        try {
            if ($request->user()->tokenCan('course-crud')) {
                Course::find($id)->delete();
                return $this->sendSuccess([], "Courses Delete Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }
}
