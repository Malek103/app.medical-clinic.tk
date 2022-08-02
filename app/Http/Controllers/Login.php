<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    public function loginPage() {
        return view("auth.login");
    }

    public function loginUser(Request $request) {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            return redirect("/");
        } else {
            return redirect()->back()->withErrors([__('lang.login_failed')]);
        }
    }
}
