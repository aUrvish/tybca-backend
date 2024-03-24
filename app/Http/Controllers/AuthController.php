<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\SubscribeCourse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function add(Request $request)
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

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            if ($request->user()->tokenCan('auth-register')) {

                // check email already exist
                if (User::where('email', $request->email)->first()) {
                    return $this->sendError("Email already exists", 409);
                }

                // genrate username and password
                $password = Str::password(8, true, true, false);
                $username = Str::lower(Str::replace(" ", '', $request->name) . Str::random(5));

                // store details
                $user = new User();
                $user->username = $username;
                $user->visible_password = $password;
                $user->password = Hash::make($password);

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

                if ($request->courses) {
                    $courseArr = explode(",", $request->courses);

                    foreach ($courseArr as $course_id) {
                        $coursePresent = SubscribeCourse::where('user_id', $user->id)->where('course_id', $course_id)->first();

                        if (!$coursePresent) {
                            $subCourse = new SubscribeCourse();
                            $subCourse->user_id = $user->id;
                            $subCourse->course_id = $course_id;
                            $subCourse->save();
                        }
                    }
                }

                $data['name'] = $request->name;
                $data['email'] = $request->email;
                $data['username'] = $username;
                $data['password'] = $password;

                // send mail
                dispatch(function () use ($data) {
                    Mail::to($data['email'])->send(new RegistrationMail($data['name'], $data['username'], $data['password']));
                });

                return $this->sendSuccess([], "Student Added Successfully");
            }

            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function login(Request $request)
    {

        try {
            // validation
            $validation = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            // check user credentials
            $user = User::where('is_deleted', 0)->where('username', $request->username)->first();

            if ($user && $user->disable == 1) {
                return $this->sendError("Account Disable", 404);
            }

            if ($user && Hash::check($request->password, $user->password)) {

                $token = null;
                if ($user->role_id == 0) {
                    $token = $user->createToken('admin-auth')->plainTextToken;
                } elseif ($user->role_id == 1) {
                    $token = $user->createToken('teacher-auth', ['course-crud', 'auth-edit-profile', 'all-students', 'save-notice', 'delete-notice', 'quiz-crud', 'show-profiles'])->plainTextToken;
                } else {
                    $token = $user->createToken('student-auth', ['all-teacher'])->plainTextToken;
                }
                $user->status = 1;
                $user->save();
                return $this->sendSuccess(['user' => $user, 'token' => $token], "Login Successful");
            }

            // wrong credentials
            return $this->sendError("Invalid username and password", 401);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function logout()
    {
        try {

            $able = DB::table('personal_access_tokens')->where('tokenable_id', auth()->user()->id)->count();
            if ($able < 2) {
                $user = User::find(auth()->user()->id);
                $user->status = 0;
                $user->save();
            }

            auth()->user()->currentAccessToken()->delete();
            return $this->sendSuccess([], "Logout Successful");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            // validation
            $validation = Validator::make($request->all(), [
                'password' => 'required|confirmed',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            // change password
            $user = auth()->user();
            $user->visible_password = $request->password;
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->sendSuccess([], "Password Changed Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function sendResetPasswordMail(Request $request)
    {
        try {

            // validation
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            $user = User::where('is_deleted', 0)->where('email', $request->email)->first();
            if (!$user) {
                return $this->sendError("User Not Found", 404);
            }

            // create token
            $token = Str::random(60);
            $data['link'] = "http://127.0.0.1:5173/reset-password/" . $token;
            $data['name'] = $user->name;
            $data['email'] = $request->email;

            // store token
            $resetToken = new PasswordResetToken();
            $resetToken->email = $data['email'];
            $resetToken->token = $token;
            $resetToken->created_at = Carbon::now();
            $resetToken->save();

            // send mail
            dispatch(function () use ($data) {
                Mail::to($data['email'])->send(new ResetPasswordMail($data['name'], $data['link']));
            });

            return $this->sendSuccess([], "Password Reset Email Sent... Please Check Your Email");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function resetPassword(Request $request, $token)
    {
        try {

            // validation
            $validation = Validator::make($request->all(), [
                'password' => 'required|confirmed',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            $resetPassword = PasswordResetToken::where('token', $token)->first();

            if (!$resetPassword) {
                return $this->sendError("Token is Invalid or Expired", 498);
            }

            // change password
            $user = User::where('is_deleted', 0)->where('email', $resetPassword->email)->first();
            $user->password = Hash::make($request->password);
            $user->visible_password = $request->password;
            $user->save();

            // delete token
            PasswordResetToken::where('email', $resetPassword->email)->delete();

            return $this->sendSuccess([], "Password Changed Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function studentShow(Request $request)
    {
        try {
            if ($request->user()->tokenCan('all-students')) {
                $students = User::with('course')->where('is_deleted', 0)->where('role_id', 2)->orderBy('updated_at', 'desc')->paginate(10);
                return $this->sendSuccess($students, "Students Fetch Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function studentSearch(Request $request)
    {
        try {
            if ($request->user()->tokenCan('all-students')) {
                $students = User::with('course')
                    ->where('is_deleted', 0)
                    ->where('role_id', 2)
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->paginate(10);
                return $this->sendSuccess($students, "Students Fetch Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function studentFilter(Request $request)
    {
        try {
            if ($request->user()->tokenCan('all-students')) {                    
                $subscribeCourse = collect(SubscribeCourse::where('course_id', $request->course_id)->with(['user' => function($q) {
                    $q->where('role_id', 2)->where('is_deleted', 0);
                }])->get());

                $subscribeCourse = $subscribeCourse->map(function($curr) {
                    return $curr['user'];
                });

                $subscribeCourse = $subscribeCourse->filter(function($curr) {
                    return $curr;
                });
                return $this->sendSuccess($subscribeCourse->paginate(10), "Students Filter Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function teacherShow(Request $request)
    {
        try {
            if ($request->user()->tokenCan('all-teacher')) {
                $students = User::with('course')->where('is_deleted', 0)->where('role_id', 1)->orderBy('updated_at', 'desc')->paginate(10);
                return $this->sendSuccess($students, "Teachers Fetch Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function teacherSearch(Request $request)
    {
        try {
            if ($request->user()->tokenCan('all-teacher')) {
                $students = User::with('course')
                    ->where('is_deleted', 0)
                    ->where('role_id', 1)
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->paginate(10);
                return $this->sendSuccess($students, "Teachers Fetch Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function teacherFilter(Request $request)
    {
        try {
            if ($request->user()->tokenCan('all-teacher')) {                    
                $subscribeCourse = collect(SubscribeCourse::where('course_id', $request->course_id)->with(['user' => function($q) {
                    $q->where('role_id', 1)->where('is_deleted', 0);
                }])->get());

                $subscribeCourse = $subscribeCourse->map(function($curr) {
                    return $curr['user'];
                });

                $subscribeCourse = $subscribeCourse->filter(function($curr) {
                    return $curr;
                });
                return $this->sendSuccess($subscribeCourse->paginate(10), "Teachers Filter Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function staffShow(Request $request)
    {
        try {
            $students = User::with('course')->where('is_deleted', 0)->orderBy('updated_at', 'desc')->where('role_id', 1)->get();
            return $this->sendSuccess($students, "Teachers Fetch Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function staffSearch(Request $request)
    {
        try {
            if ($request->user()->tokenCan('all-teacher')) {
                $students = User::with('course')
                    ->where('is_deleted', 0)
                    ->where('role_id', 1)
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->get();
                return $this->sendSuccess($students, "Teachers Fetch Successfully");
            }
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function remove(Request $request, $id)
    {
        try {
            if ($request->user()->tokenCan('auth-remove')) {
                $user = User::find($id);
                $user->is_deleted = 1;
                $user->save();

                DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();
                return $this->sendSuccess([], "User Remove Successfully");
            }
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function userDisbale(Request $request)
    {
        try {
            if ($request->user()->tokenCan('auth-disable')) {
                $user = User::find($request->id);
                $user->disable = $request->status ? 1 : 0;
                $user->save();

                DB::table('personal_access_tokens')->where('tokenable_id', $request->id)->delete();
                return $this->sendSuccess([], "User Disable Successfully");
            }
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }
}
