<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Auth;
use Illuminate\Validation\Rule;

class Users extends Controller
{
    public function index() {

        $users = User::orderBy('id', 'DESC')->get();
        return view("users.index")->with(["data" => $users]);
    }

    public function create() {
        return view("users.create");
    }

    public function store(Request $request) {
        $rules=$this->rules();
        $request->validate($rules);
        $data = $request->all();
        if ($this->checkIfEmailExist($request->email)) {
            return redirect()->back()->withErrors([__('lang.email_exists')]);
        }
        if ($request->hasFile('image')) {
            $name = time() . "_user." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect("/users");
    }

    public function edit($id) {
        $user = User::find($id);
        return view("users.edit")->with(["item" => $user]);
    }

    public function update(Request $request) {
        $rules=$this->rules($request->id);
        $request->validate($rules);
        $user = User::find($request->id);

        $data = $request->all();

        if($request->email != $user->email) {
            if($this->checkIfEmailExist($request->email)) {
                return redirect()->back()->withErrors([__('lang.email_exists')]);
            }
        }

        if ($request->has('password')) {
            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }else {
                unset($data['password']);
            }
        }
        if ($request->hasFile('image')) {
            $name = time() . "_user." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        $user->fill($data)->save();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function destroy($id) {
        User::find($id)->delete();
        return redirect()->back();
    }

    public function switchLanguage() {
        if(Cookie::get('locale')) {
            Cookie::queue(Cookie::forget('locale'));
        }else {
            Cookie::queue('locale', 'en', 525948);
        }
        return redirect()->back();
    }

    public function myAccount() {
        return view("users.myaccount");
    }

    public function updateCurrentUser(Request $request) {
        $user = User::find(auth()->user()->id);

        $data = $request->all();

        if($request->email != $user->email) {
            if($this->checkIfEmailExist($request->email)) {
                return redirect()->back()->withErrors([__('lang.email_exists')]);
            }
        }

        if ($request->has('password')) {
            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }else {
                unset($data['password']);
            }
        }
        if ($request->hasFile('image')) {
            $name = time() . "_user." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        $user->fill($data)->save();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function switchMode() {
        if(Cookie::get('darkmode')) {
            Cookie::queue(Cookie::forget('darkmode'));
        }else {
            Cookie::queue('darkmode', 'true', 525948);
        }
        return redirect()->back();
    }

    public function logout() {
        Auth::logout();
        return redirect("/");
    }

    public function checkIfEmailExist($email)
    {
        $user = User::where('email', $email)->count();
        if ($user > 0) {
            return true;
        }
        return false;
    }

    public function rules($id=0){

        return  [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'name')->ignore($id, 'id'),
            ],
            'email' => 'required|max:255|email',
            'password'=>'required',
        ];

    }

}
