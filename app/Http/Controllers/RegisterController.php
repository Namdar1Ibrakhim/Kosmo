<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function save(Request $request){

        $validateFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(User::where('email', $validateFields['email'])->exists()){
            return redirect(route('user.registration'))->withErrors([
                'email'=> 'Такой пользователь уже зарегестрирован'
            ]);
        }

        $user = User::create($validateFields);
        if($user){
            Auth::login($user);
            return redirect('home');
        }

        return redirect(route('user.registration'))->withErrors([
            'formError'=> 'Произошла ошибка при сохранении пользователя'
        ]);
    }
}
