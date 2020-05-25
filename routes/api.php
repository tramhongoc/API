<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'prefix' => 'user'
], function(){
   Route::post('login', 'UserController@login');
   Route::group([
       'middleware' => 'auth:api'
    ], function(){
        Route::post('logout','UserController@logout');
        Route::get('profile','UserController@profile');
    });
});



