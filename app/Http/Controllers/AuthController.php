<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\SubscribeCourse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
                $password = fake()->unique()->password();
                $username = fake()->unique()->userName();

                // store details
                $user = new User();
                $user->username = $username;
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
                    $courseArr = explode(",",$request->courses);
                    
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
            $user = User::where('username', $request->username)->first();
            if ($user && Hash::check($request->password, $user->password)) {

                $token = null;
                if ($user->role_id == 0) {
                    $token = $user->createToken('admin-auth')->plainTextToken;
                } elseif ($user->role_id == 1) {
                    $token = $user->createToken('teacher-auth', ['course-crud', 'auth-edit-profile'])->plainTextToken;
                } else {
                    $token = $user->createToken('student-auth', [])->plainTextToken;
                }

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
            auth()->user()->tokens()->delete();
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

            $user = User::where('email', $request->email)->first();
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
            $user = User::where('email', $resetPassword->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            // delete token
            PasswordResetToken::where('email', $resetPassword->email)->delete();

            return $this->sendSuccess([], "Password Changed Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }
}
