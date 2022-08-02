<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function checkIfEmailExist($email)
    {
        $user = User::where('email', $email)->count();
        if ($user > 0) {
            return true;
        }
        return false;
    }

    public function getCurrentUserInfo()
    {
        return response()->json(auth()->user());
    }

    public function getAllUsers()
    {
        $users = User::all();
        return response()->json(["data" => $users], 200);
    }

    public function storeUser(Request $request)
    {
        $data = $request->all();
        if ($this->checkIfEmailExist($request->email)) {
            return response()->json(["status" => false, "error" => "email_exist"]);
        }
        if ($request->hasFile('image')) {
            $name = time() . "_user." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return response()->json(["status" => true], 200);
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(["status" => false]);
        }
        $data = $request->all();
//        if($request->email) {
//            if($request->email != $user->email) {
//                if($this->checkIfEmailExist($request->email)) {
//                    return response()->json(["status" => false, "error" => "email_exist"]);
//                }
//            }
//        }
        if ($request->has('password')) {
            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }
        }
        if ($request->hasFile('image')) {
            $name = time() . "_user." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        $user->fill($data)->save();
        return response()->json(["status" => true], 200);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return response()->json(["status" => true], 200);
    }

    public function updateCurrentUser(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if (!$user) {
            return response()->json(["status" => false]);
        }
        $data = $request->all();
        if ($request->email) {
            if ($request->email != $user->email) {
                if ($this->checkIfEmailExist($request->email)) {
                    return response()->json(["status" => false, "error" => "email_exist"]);
                }
            }
        }
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            $name = time() . "_user." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        $user->fill($data)->save();
        return response()->json(["status" => true], 200);
    }

}
