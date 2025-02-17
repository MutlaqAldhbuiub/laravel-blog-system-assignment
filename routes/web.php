<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Middleware\CheckNationalId;
use App\Http\Middleware\CheckGender;
use Illuminate\Support\Facades\Auth;


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


Auth::routes();

Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')
    ->name('social.login');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')
    ->name('social.callback');

// Authorized (check if he update his profile and successfully add gender & national id

Route::middleware(['auth'])->group(function () {
    Route::get('/authorized', "AuthorizedController@index")->name('show-authorized');
    Route::match(['put', 'patch'], '/authorized', "AuthorizedController@update")->name('authorized');

    Route::middleware([CheckGender::class,CheckNationalId::class])->group(function () {
        // User
        Route::get('/settings', "SettingsController@index")->name("settings");
        Route::post('/settings', "SettingsController@store")->name("settings-store");
        Route::get('/settings/posts', 'PostController@myPosts')->name("myPosts");
        // Main
        Route::get('/home', 'HomeController@index')->name('home');
        // Posts
        Route::get('/posts/create', 'PostController@create')->name("showCreatePost");
        Route::get('/posts/{slug}', 'PostController@show')->name('showPost');
        Route::post('/posts/create', 'PostController@store')->name('createPost');
    });
});
