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

Route::get('/',[
    'uses'=>'TestController@getWelcome',
    'as'=>'welcome'
]);

Route::get('/home',[
    'uses'=>"TestController@getHome",
    'as'=>'home'
]);
Route::post('/post/new',[
    'uses'=>'TestController@postNewpost',
    'as'=>'post.new'
]);
Route::get('/post/id/{id}/remove',[
   'uses'=>'TestController@postRemove',
   'as'=>'post.remove'
]);
Route::get('/post/id/{id}/edit',[
    'uses'=>'TestController@postEdit',
    'as'=>'post.edit'
]);
Route::post('/post/update',[
    'uses'=>'TestController@postUpdate',
    'as'=>'post.update'
]);
Route::post('/post/search',[
    'uses'=>'TestController@postSearch',
    'as'=>'post.search'
]);