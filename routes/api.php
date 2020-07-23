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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login');
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('profile', 'JWTAuthController@profile');
});


Route::get('/issue/{issue:slug}', "IssueController@show");
Route::get('/issue', "IssueController@index");
Route::get('/issue/all', "IssueController@all");
Route::post('/issue', "IssueController@store");
Route::put('/issue/{issue:slug}', "IssueController@update");
Route::put('/issue/count/{issue:slug}', "IssueController@updateCount");
Route::delete('/issue/{issue:slug}', "IssueController@destroy");

Route::get('/book', "BookController@index");
Route::post('/book', "BookController@store");
Route::get('/book/{book:slug}', "BookController@show");
Route::put('/book/{book:slug}', "BookController@update");
Route::put('/book/count/{book:slug}', "BookController@updateCount");
Route::delete('/book/{book:slug}', "BookController@destroy");

Route::get('/post', "PostController@index");
Route::post('/post', "PostController@store");
Route::get('/post/{post:slug}', "PostController@show");
Route::put('/post/{post:slug}', "PostController@update");
Route::delete('/post/{post:slug}', "PostController@destroy");




Route::get('/subscribers', "SubscriberController@index");
Route::post('/subscribers', "SubscriberController@store");
Route::get('/subscribers/{subscriber}', "SubscriberController@show");
Route::put('/subscribers/{subscriber}', "SubscriberController@update");
Route::delete('/subscribers/{subscriber}', "SubscriberController@delete");

Route::get('/report', "ReportController");
Route::post('/autodeploy', "DeploymentController@deploy");