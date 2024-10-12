<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{
    public function upload($folder = 'images', $key = 'avatar')
    {
        $file = null;
        if (request()->hasFile($key)) {
            $file = Storage::disk('public')->putFile($folder, request()->file($key), 'public');
        }
        return $file;
    }

    public function sendSuccess($data = [], $messages, $code = 200){
        $obj = [
            'status' => true,
            'data' => $data,
            'messages' => $messages
        ];
        return response()->json($obj , $code);
    } 

    public function sendError($messages, $code = 404){
        $obj = [
            'status' => false,
            'messages' => $messages
        ];
        return response()->json($obj , $code);
    } 
}
