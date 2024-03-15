<?php

namespace App\Http\Controllers;

use App\Models\SubscribeCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProfileController extends BaseController
{
    public function profile()
    {
        try {
            $id = auth()->user()->id;
            $user = User::where('is_deleted' , 0)->with('course')->where('id', $id)->first();
            return $this->sendSuccess($user, "User Data");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function authProfileEdit(Request $request)
    {
        try {
            // validation
            $validation = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|numeric',
                'gender' => 'required',
                'city' => 'required',
                'country' => 'required'
            ]);

            // check email already exist
            if (User::where('email', $request->email)->first()) {
                return $this->sendError("Email already exists", 409);
            }

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            if ($request->user()->tokenCan('auth-edit-profile')){
                // store details
                $user = User::find(auth()->user()->id);
                
                if ($request->hasFile('avatar')) {
                    $avatar_url = $this->upload('avatar', 'avatar');
                    $user->avatar = $avatar_url;
                }
                
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->gender = $request->gender;
                $user->city = $request->city;
                $user->country = $request->country;
                $user->save();

                $courseArr = explode(",",$request->courses);
                $subCourse = SubscribeCourse::where('user_id', $user->id)->get();

                foreach ($courseArr as $course_id) {
                    $coursePresent = SubscribeCourse::where('user_id', $user->id)->where('course_id', $course_id)->first();

                    if (!$coursePresent) {
                        $subCourses = new SubscribeCourse();
                        $subCourses->user_id = $user->id;
                        $subCourses->course_id = $course_id;
                        $subCourses->save();
                    }
                }

                if ($subCourse) {
                    foreach ($subCourse as $subscribe) {
                        if (!in_array($subscribe->course_id, $courseArr)) {
                            SubscribeCourse::find($subscribe->id)->delete();
                        }
                    }
                }

                return $this->sendSuccess([], "Student Updated Successfully");
            }

            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function profilesEdit(Request $request)
    {
        try {

            // validation
            $validation = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|numeric',
                'gender' => 'required',
                'city' => 'required',
                'country' => 'required'
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            if ($request->user()->tokenCan('edit-profiles')){
                // store details
                $user = User::find($request->id);
                
                // check email already exist
                if (User::where('email', $request->email)->first()) {
                    return $this->sendError("Email already exists", 409);
                }

                if ($request->hasFile('avatar')) {
                    $avatar_url = $this->upload('avatar', 'avatar');
                    $user->avatar = $avatar_url;
                }
                
                if ($request->role == "teacher") {
                    $user->role_id = 1;
                }
                
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->gender = $request->gender;
                $user->city = $request->city;
                $user->country = $request->country;
                $user->save();

                $courseArr = explode(",",$request->courses);
                $subCourse = SubscribeCourse::where('user_id', $request->id)->get();

                foreach ($courseArr as $course_id) {
                    $coursePresent = SubscribeCourse::where('user_id', $request->id)->where('course_id', $course_id)->first();

                    if (!$coursePresent) {
                        $subCourses = new SubscribeCourse();
                        $subCourses->user_id = $request->id;
                        $subCourses->course_id = $course_id;
                        $subCourses->save();
                    }
                }

                if ($subCourse) {
                    foreach ($subCourse as $subscribe) {
                        if (!in_array($subscribe->course_id, $courseArr)) {
                            SubscribeCourse::find($subscribe->id)->delete();
                        }
                    }
                }

                return $this->sendSuccess([], "Student Updated Successfully");
            }

            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function userProfile(Request $request, $id) {
        try {
            if ($request->user()->tokenCan('show-profiles')){
                $user = User::with('course')->where('is_deleted' , 0)->where('id', $id)->first();
                return $this->sendSuccess($user, "Profile fetched Successfully"); 
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

}
