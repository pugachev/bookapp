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

    //初期画面一覧取得処理
    public function index()
    {
	    $books = Book::all();
      // $books = DB::select('select * from books');
      // print_r($books->toArray());
      $tmp = $books->toArray();
      for($i=0;$i<count($tmp);$i++)
      {
        print_r($tmp[$i]['title']);
      }
      // dd(count($books));
		  return view('books',['books'=>$books]);
    }

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

    //投稿削除処理
    public function deleteTitle(Book $book)
    {
	    $book->delete();

      return redirect('/');
    }

    //投稿・コメント削除処理
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

    //投稿に対応する詳細記事一覧を取得する処理
    public function detail(Book $book)
    {
      $book = Book::findOrFail($book->id);
      return view('detail')->with('book', $book);
    }

    //投稿に対する詳細記事を投稿する処理
    public function store(Request $request,Book $book)
    {

      $comment = new Comment(['comment' => $request->comment]);
      $comment->book_id = $book->id;
      $book->comments()->save($comment);
      return redirect()->action('Controller@detail', $book);
    }

    //コメント投稿削除処理
    public function commentDelete(Comment $comment)
    {

      // dd($comment->id);
      // $comment = $book->comments();
      $tmpcomment = Comment::findOrFail($comment->id);
      $tmpcomment->delete();
      $book = Book::findOrFail($comment->book_id);
      return view('detail')->with('book', $book);

      // return redirect('/');
      // return redirect()->action('Controller@index', $book);
    }
    // public function destroy(Post $post, Comment $comment)
    // {
    //   $comment->delete();
    //   return redirect()->back();
    // }
}
