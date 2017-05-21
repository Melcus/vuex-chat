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

use App\Transformers\ConversationTransformer;

Route::get('/' , function () {
	return view('welcome');
});

Auth::routes();


Route::group(['prefix' => 'webapi', 'namespace' => 'Api'] , function () {
	Route::get('/conversations', 'ConversationController@index');
	Route::post('/conversations', 'ConversationController@store');
	Route::get('/conversations/{conversation}', 'ConversationController@show');
	Route::post('/conversations/{conversation}/reply', 'ConversationReplyController@store');
	Route::post('/conversations/{conversation}/users', 'ConversationUserController@store');
	
});

Route::get('/home' , 'HomeController@index')->name('home');
Route::get('/conversations' , 'ConversationController@index')->name('conversations.index');
Route::get('/conversations/{conversation}' , 'ConversationController@show')->name('conversation.show');

Route::Get('testing', function() {

	dd('https://www.gravatar.com/avatar/' . md5('tirdea.mihail.vlinde.com') . 'x?s=' . '45' . '&d=mm');
	
	
});


