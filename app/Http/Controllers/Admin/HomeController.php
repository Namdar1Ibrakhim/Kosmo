<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request){
        return view('home');
    }
    public function users(Request $request){
        return view('users', ['data' =>  User::all()]);
    }

}
