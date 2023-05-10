<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $formFields = $request->only(['email', 'password']);

        if(Auth::attempt($formFields)){
            return redirect('home');
        }

        return redirect(route('user.login'))->withErrors([
            'email' => 'Не удалось авторизоваться'
        ]);
    }
}
