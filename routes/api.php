<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user-info', 'Api\UserController@getUserInfo');
    Route::post('logout', 'Api\UserController@logout');

    Route::post('phrases/storage/out', 'Api\PhraseController@getAllPhraseOutStorage');
    Route::post('phrases/storage/add', 'Api\PhraseController@addToStorage');
    Route::post('phrases/storage', 'Api\PhraseController@storage');
    Route::post('phrases/storage/remove', 'Api\PhraseController@remove');
    Route::post('phrases/learn', 'Api\PhraseController@learn');

    Route::post('words/storage/out', 'Api\WordController@getAllWordOutStorage');
    Route::post('words/storage/add', 'Api\WordController@addToStorage');
    Route::post('words/storage', 'Api\WordController@storage');
    Route::post('words/storage/remove', 'Api\WordController@remove');
    Route::post('words/learn', 'Api\WordController@learn');
});

// Route::get('lessons', 'Api\LessonController@getAllLesson');

Route::group(['middleware' => 'cors'], function () {
    Route::get('lessons', 'Api\LessonController@getAllLesson');
    Route::get('lessons/{alias}', 'Api\LessonController@learn');    

    Route::get('phrases', 'Api\PhraseController@getAllPhrase');

    Route::get('words', 'Api\WordController@getAllWord');
    
    Route::post('auth/register', 'Api\UserController@register');
    Route::post('auth/login', 'Api\UserController@login');
    Route::post('profile/update', 'Api\UserController@update_profile');
});