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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('posts','API\PostController@index');
Route::get('posts/{slug}','API\PostController@show');
Route::match(['put', 'patch'],'posts/{slug}','API\PostController@update');
Route::delete('posts/{slug}','API\PostController@destroy');

// posts comments
Route::get('posts/{slug}/comments','API\PostController@comments');
Route::get('posts/{slug}/comment/{id}','API\PostController@comment');
Route::post('posts/{slug}/comments','API\PostController@add_comment');

Route::post('users/id','API\PostController@user');

