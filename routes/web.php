<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAuth;
use Illuminate\Support\Facades\Route;

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


Route::get('/',[UserAuth::class,'index'])->name('user.login');
Route::get('/register',[UserAuth::class,'register'])->name('user.register');

Route::post('/',[UserAuth::class,'user_register_submit'])->name('user_register_submit');
Route::post('/user_login',[UserAuth::class,'user_login'])->name('user_login_submit');



Route::get('/logout',[UserAuth::class,'logout'])->name('user.logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/userdashboard',[ProductController::class,'index'])->name('dashboard');

    Route::resource('product', ProductController::class,[
        'except' => ['index','show']
    ]);
    Route::get('/products/show',[ProductController::class,'show'])->name('product.show');
});
