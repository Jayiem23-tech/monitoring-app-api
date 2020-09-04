<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix'=>'monitoring'],function(){
    Route::post("imports","ImportCsvToDbController@imports"); 
    Route::get("show","ImportCsvToDbController@show"); 
});
Route::get("register","UserRegistrationController@register");
Route::get("setMonth","NotificationOptionController@setMonth"); 
Route::get("getNotify","NotificationOptionController@getNotification"); 
Route::get("ShowAll","ShowDataController@ShowAll"); 




 