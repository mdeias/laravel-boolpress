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

Route::get('prova', function(){
    
    $user = [
        'name'=>'Paolo', 
        'lastname'=>'Rossi'];
    
    return response()->json(compact('user'));

});

// Route::get('posts', 'PostController@index');
// Route::get('posts/{slug}', 'PostsController@show');

Route::namespace('Api')
   ->prefix('posts')
   ->group(function(){

       Route::get('/', 'PostController@index');
       Route::get('{slug}', 'PostController@show');

   });
