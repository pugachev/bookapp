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

class CommentsController extends Controller
{
  // use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
  //
  // public function __construct()
  // {
  //   $this->middleware('auth');
  // }
  //
  // //コメント投稿削除処理
  // public function commnetDelete(Book $book)
  // {
  //   $comment=$book->comment;
  //   $comment->delete();
  //
  //   // return redirect('/');
  //   return redirect()->action('Controller@index', $book);
  // }
}
