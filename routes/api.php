<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\UserHomeController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Public API
Route::post('register', [UserAuthController::class, 'register_user']);
Route::post('login', [UserAuthController::class, 'login_user']);


Route::get('test', [UserHomeController::class, 'test']);
//After Login API
    Route::post('user-token-list-al', [UserHomeController::class, 'login_token_list_al']);
    Route::get('get-user', [UserHomeController::class, 'get_user']);
    Route::post('update-user-al', [UserHomeController::class, 'update_user_al']);
    Route::post('update-user-password-al', [UserHomeController::class, 'update_user_password_al']);
    //Route::post('gallery-list-view', 'UserHomeController@sermon_list_view');


	Route::get('/home', [App\Http\Controllers\Api\PageController::class, 'index']);
	Route::post('/enquiry', [App\Http\Controllers\Api\PageController::class, 'enquiry']);
	Route::post('/enquiry-popup', [App\Http\Controllers\Api\PageController::class, 'enquiry_popup']);


	Route::get('/contact', [App\Http\Controllers\Api\PageController::class, 'contact']);
	Route::post('/contact', [App\Http\Controllers\Api\PageController::class, 'contactform']);
	Route::get('/page', [App\Http\Controllers\Api\PageController::class, 'ShowPage']);
Route::middleware(['auth:sanctum'])->group(function () {
//Route::group(['middleware' => ['auth']], function () {
});

