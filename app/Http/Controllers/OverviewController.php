<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OverviewController extends BaseController
{
    public function get(){
        
        try {
            $students = User::where('role_id', 2)->count();
            $teachers = User::where('role_id', 1)->count();

            $data = [
                'students' => $students,
                'teachers' => $teachers
            ];

            return $this->sendSuccess($data, "Fetch Data Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    } 

    public function students(Request $request) {
        try {
            if ($request->user()->tokenCan('all-students')) {
                $students = User::where('role_id', 2)->orderBy('created_at')->take(5)->get();
                return $this->sendSuccess($students, "Fetch Data Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        } 
    }

    public function teachers(Request $request) {
        try {
            if ($request->user()->tokenCan('all-teacher')) {
                $teachers = User::where('role_id', 1)->orderBy('created_at')->take(5)->get();
                return $this->sendSuccess($teachers, "Fetch Data Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        } 
    }
}
