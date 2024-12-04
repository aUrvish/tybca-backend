<?php

namespace App\Http\Controllers;

use App\Models\AssignRole;
use App\Models\RootUser;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TenantAuthController extends BaseController
{
    public function add(Request $request) {
        try {
            // validation
            $validation = Validator::make($request->all(), [
                'domain' => 'required',
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

            // check email already exist
            if (RootUser::where('email', $request->email)->first()) {
                return $this->sendError("Email already exists", 409);
            }

            // store details
            $user = new RootUser();
            $user->password = Hash::make($request->password);

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

            // Assign role
            $role = new AssignRole();
            $role->root_users_id = $user->id;
            $role->role_id = 2;
            $role->save();

            // Tenant account setup
            $tenant = Tenant::create([
                'name' => $request->name,
                'root_users_id' => $user->id
            ]);

            $tenant->domains()->create([
                'domain' => $request->domain . "." . config('app.domain')
            ]);

            return $this->sendSuccess([], "Account Created Successfully");
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), 500);
        }
    }
}
