<?php

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
   return redirect('/home');
});


// Authentication Routes
Auth::routes([
    'register' => false,
    'verify' => false,
    "reset" => false,
]);

Route::middleware('auth')->group(function (){

    Route::get('/profile',[HomeController::class , 'profile']);
    Route::post('/profile','UserController@profile');

    Route::middleware('complete')->group(function (){
        Route::get('/home', [HomeController::class , 'index'])->name('home');
        Route::post('/apply',[LeaveController::class , 'store']);
        Route::get('/leaves/{leave}/close',[LeaveController::class , 'close'])->middleware('can:close,leave');
        Route::get('/leaves/{leave}/authorize',[LeaveController::class , 'authoriz'])->middleware('can:authorize,leave');
        Route::get('/leaves/{leave}/recommend',[LeaveController::class , 'recommend'])->middleware('can:recommend,leave');
        Route::get('/leaves/{leave}/download',[LeaveController::class , 'download']);
        Route::get('/leaves/{leave}/view',[LeaveController::class , 'view'])->middleware('can:view,leave');
        Route::get('/requests',[LeaveController::class , 'requests']);
        Route::get('/requests/all',[LeaveController::class , 'all']);
        Route::get('/users','UserController@index');
        Route::get('/users/{user}/view','UserController@view')->middleware('can:view,user');;
        Route::post('/users/{user}/view','UserController@update')->middleware('can:view,user');;
        Route::get('/index','HomeController@index');
        Route::get('/reports/{type}',[ReportController::class , 'index']);
    });

});
