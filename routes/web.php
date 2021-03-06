<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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
Route::get('login', function(){
    return view('login');
})->name('login');
Route::group(['middleware'=>'web'], function(){
    Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('loginWithProvider');
    Route::get('{provider}/callback', [LoginController::class, 'handleProviderCallback']);
    Route::get('/home', function () {
        return 'User is logged in';
    });
});




