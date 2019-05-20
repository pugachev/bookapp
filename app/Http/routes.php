<?php

use App\Book;
use Illuminate\Http\Request;

Route::group(['middlewareGroups' => ['web']],function(){

	Route::get('/','Controller@index');

	Route::post('/book','Controller@createTitle');

	Route::post('/book/remove/{book}','Controller@remove');

	Route::post('/book/{book}','Controller@store');

	Route::get('/book/detail/{book}','Controller@detail');

	Route::get('/book/commentDelete/{comment}','Controller@commentDelete');

	Route::auth();
});
