<?php

namespace App\Http\Controllers;

use App\Book;
use App\Comment;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
	    $this->middleware('auth');
    }

    public function index()
    {
	    $books = Book::all();
		  return view('books',['books'=>$books]);
    }

    //新規投稿処理
    public function createTitle(Request $request)
    {
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
      $book->image_url=$request->file('image_url')->move('public/uploadImage', $request->name.'.jpg');
      // $comment = new Comment(['comment' => '']);
      // $comment->book_id = $book->id;
      // $book->comments()->save($comment);
  		$book->save();

  		return redirect('/');
    }

    public function deleteTitle(Book $book)
    {
	    $book->delete();

      return redirect('/');
    }

    public function remove(Request $request,Book $book)
    {
      // $comment=Comment::findOrFail($book);
      // $comment=$query->where('book_id',$book->id);
      $comment=DB::table('comments')->where('book_id', $book->id);
      // dd($comment);
      $comment->delete();
      // dd($request->bookid);
	    $book->delete();

      return redirect('/');
    }

    public function detail(Book $book)
    {
      $book = Book::findOrFail($book->id);
      return view('detail')->with('book', $book);
    }

    public function store(Request $request,Book $book)
    {

      $comment = new Comment(['comment' => $request->comment]);
      $comment->book_id = $book->id;
      $book->comments()->save($comment);
      return redirect()->action('Controller@detail', $book);
    }

    // public function destroy(Post $post, Comment $comment)
    // {
    //   $comment->delete();
    //   return redirect()->back();
    // }
}
