<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        return view("admin.auth.login");
    }
    public function login()
    {
        if (Auth::check()) {
            return redirect("/dashboard");
        } else {
            return redirect("/login");
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::attempt($data)) {
            return redirect('/dashboard');
        } else {
            Session::flash('error','salah');
            return redirect('/login');
        }
    }

    public function actionlogout(){
        Auth::logout();
        return redirect('/login');
    }

}
