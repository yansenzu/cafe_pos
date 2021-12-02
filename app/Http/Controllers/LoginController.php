<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
       return view('login');
    }
    
    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->where('password', $password)->first();

        if ($user) {
            if ($user->password == $password) {
                $request->session()->put('username', $username);
                return redirect('/');
            } else {
                return redirect('/login')->with('alert', 'Password Salah');
            }
        } else {
            return redirect('/login')->with('alert', 'Username Tidak Ada');
        }
    }

    public function register(){
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        if($user){
            return redirect('/login')->with('alert', 'Register Berhasil');
    }
    else{
        return redirect('/register')->with('alert', 'Register Gagal');
    }
    }
}
