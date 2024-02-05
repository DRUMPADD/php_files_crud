<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Throwable;

class UserController extends Controller
{
    public function show() {
        if(Auth::check()) {
            return redirect('/archivos');
        }
        return view('accounts.login');
    }

    public function login(LoginRequest $request) {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)) {
            return redirect()->to('/')->withErrors('Email y contraseña son requeridos.');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return $this->authenticated($request, $user);
    }

    public function register(RegisterRequest $request) {
        try {
            $user = \App\Models\User::create($request->validated());
            return redirect('/')->with('success', 'Cuenta '.$user.' creada de manera exitosa');
        } catch(Throwable $e) {
            return redirect('/')->with('error', 'Error al crear cuenta');
        }
    }

    public function authenticated(Request $request, $user) {
        return redirect('/archivos');
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect()->to('/');
    }
}
