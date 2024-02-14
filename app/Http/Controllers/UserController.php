<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Throwable;

class UserController extends Controller
{
    public function show() {
        if(Auth::check()) {
            return redirect("/archivos");
        }
        return view("accounts.login");
    }
    public function login(Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');
        $users = \App\Models\User::all();
        $myuser = $users->where('email', $email)->where('password', $password)->first();
        /* if(!$myuser) {
            return redirect()->to('/')->withErrors('El email y/o contraseña son incorrectos.');
        }*/
        if(!Auth::validate(["email" => $email, "password" => $password])) {
            return redirect()->to('/')->withErrors('Email y contraseña son requeridos.');
        }

        $user = Auth::getProvider()->retrieveByCredentials(["email" => $email, "password" => $password]);
        Auth::login($user);
        return $this->authenticated($request, $user);
    }

    public function register(RegisterRequest $request) {
        try {
            $email_exists = \App\Models\User::all()->where('email', $request->email)->first();
            if($email_exists) {
                return redirect()->to('/')->withErrors('El email y/o contraseña son incorrectos.');
            }
            \App\Models\User::create($request->validated());
            return redirect()->to('/')->with('success', 'Su cuenta ha sido creada.');
        } catch(Throwable $e) {
            return redirect()->to('/')->with('error', 'Error al registrar cuenta');
        }
    }

    public function authenticated(Request $request, $user) {
        return redirect("/archivos");
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect()->to("/");
    }
}
