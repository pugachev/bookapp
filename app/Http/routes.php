<?php

use App\Book;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', function () {
    return view('book');
});
*/

Route::group(['middlewareGroups' => ['web']],function(){

	Route::get('/','Controller@index');
/*
	Route::get('/',['middleware'=> 'auth',function(){
		$books = Book::all();
		return view('books',['books'=>$books]);
	}]);
*/

	Route::post('/book','Controller@createTitle');

// 	Route::post('/book/{book}','Controller@updateTitle');

/*
	Route::post('/book',['middleware'=> 'auth',function(Request $request){

		$validator = Validator::make($request->all(),[
			'name'=>'required|max:255',
		]);
		if($validator->fails()){
			return redirect('/')
			->withInput()
			->withErrors($validator);
		}

		$book = new Book;
		$book->title=$request->name;
		$book->save();

		return redirect('/');

	}]);
*/

// 	Route::delete('/book/{book}','Controller@deleteTitle');
	Route::post('/book/remove/{book}','Controller@remove');
	Route::post('/book/{book}','Controller@store');

	Route::get('/book/detail/{book}','Controller@detail');
/*
	Route::delete('/book/{book}',['middleware'=> 'auth',function(Book $book){

		$book->delete();

		return redirect('/');

	}]);
*/

	Route::auth();
});
