<?php

namespace App\Http\Controllers;

use App\Events\NoticePublish;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NoticeController extends BaseController
{
    public function save(Request $request){
        try {

            // validation
            $validation = Validator::make($request->all(), [
                'title' => 'required',
                'caption' => 'required',
            ]);

            // validation error
            if ($validation->fails()) {
                return $this->sendError("Validation Error", 403);
            }

            if ($request->user()->tokenCan('save-notice')) {
                if ($request->id) {
                    $notice = Notice::find($request->id);
                }else {
                    $notice = new Notice();
                    $notice->uri = Str::random(10);
                }

                $notice->user_id = auth()->user()->id;
                $notice->title = $request->title;
                $notice->caption = $request->caption;
                $notice->textarea = $request->textarea;
                $notice->save();

                return $this->sendSuccess($notice, "Notice Save Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function delete(Request $request, $id){
        try {
            if ($request->user()->tokenCan('delete-notice')) {
                $notice = Notice::find($id);
                if ($notice && $notice->where('user_id' , auth()->user()->id)) {
                    $notice->delete();
                    return $this->sendSuccess($notice, "Notice Remove Successfully");
                }
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function status(Request $request)
    {
        try {
            if ($request->user()->tokenCan('save-notice')) {
                $notice = Notice::find($request->id);
                $notice->status = $request->status ? 1 : 0;
                $notice->save();
                return $this->sendSuccess($notice, "Status Change Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function publish(Request $request, $id)
    {
        try {
            if ($request->user()->tokenCan('save-notice')) {
                $notice = Notice::find($id);
                $notice->publish_at = Carbon::now();
                $notice->status = 1;
                $notice->save();
                event(new NoticePublish());
                return $this->sendSuccess($notice, "Notice Publish Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function get($uri)
    {
        try {
            $notice = Notice::with('user')->where('uri', $uri)->first();
            if ($notice && 
            (!Notice::where('uri', $uri)->where('status' , 0)->first() || 
            Notice::where('uri', $uri)->where('user_id' , auth()->user()->id)->first()) ) {
                return $this->sendSuccess($notice, "Notice Fetch Successfully");
            }
            return $this->sendError("Not Found", 404);
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function show($id)
    {
        try {
            $notice = Notice::find($id);
            return $this->sendSuccess($notice, "Notice Fetch Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function all()
    {
        try {
            $noticePublish = Notice::with('user')->where('status', 1)->orderBy('updated_at', 'desc')->get();
            $noticeDraf = Notice::orderBy('updated_at', 'desc')->with('user')->where('status', 0)->where('user_id', auth()->user()->id)->get();
            $notice = $noticeDraf->merge($noticePublish)->paginate(10);
            return $this->sendSuccess($notice, "Notice Get Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function getAllPublish()
    {
        try {
            $notice = Notice::with('user')->orderBy('updated_at' , 'desc')->where('status', 1)->get();            
            return $this->sendSuccess($notice, "Notice Get Successfully");
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), 500);
            // return $this->sendError("Internal Server Error", 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $notice = Notice::with('user')->where('name', 'like', '%' . $request->search . '%')->paginate(10);
            return $this->sendSuccess($notice, "Notice Fetch Successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }

    public function uploadImage(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                return response()->json(['location' =>  $request->root() . '/storage/' . $this->upload('notice', 'file')]);
            }
        } catch (\Throwable $th) {
            return $this->sendError("Internal Server Error", 500);
        }
    }
}
