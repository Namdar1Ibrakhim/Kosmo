<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::name('user.')->group(function(){

Route::get('/login', function(){
    return view('login');
})->name('login');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

Route::get('/logout', function(){
    Auth::logout();
    return redirect(route('user.login'));
})->name('logout');

Route::get('/registration', function(){
    return view('registration');
})->name('registration');

Route::post('/registration', [App\Http\Controllers\RegisterController::class, 'save']);
});

Route::get('home', [HomeController::class, 'home']);
Route::get('users', [HomeController::class, 'users'])->middleware('auth');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
//    Route::resource('users', UserController::class);
//    Route::resource('products', ProductController::class);
});
