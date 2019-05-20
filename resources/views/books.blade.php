@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.mylist{
		  background-color: gray;
		  width: 70px; height: 70px;
		  object-fit: contain;
		}
		img{
		  background-color: gray;
		  width: 100px; height: 100px;
		  object-fit: contain;
		}
	</style>
	<script>

	</script>
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					New books
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New books Form -->
					<form action="{{ action('Controller@createTitle') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!-- books Name -->
						<div class="form-group">
							<label for="task-name" class="col-sm-3 control-label">books</label>

							<div class="col-sm-6">
								<input type="text" name="name" id="books-name" class="form-control" value="{{ old('books') }}">
							</div>
						</div>
						<div class="form-group">

							<div class="col-sm-offset-3 col-sm-6">
								<input type="file" class="form-control" name="image_url">
							</div>
						</div>
						<!-- Add books Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-plus"></i>本を追加する
								</button>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal">
								    デモ：ノーマルバージョン
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			@if (count($books) > 0)
				@php($tmp = $books->toArray())
					<div class="panel-body">
						<div id="sampleCarousel" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								@for($i=0;$i<count($tmp);$i++)
									@if($i==0)
										<li class="active" data-target="#sampleCarousel" data-slide-to="{{$i}}"></li>
									@else
										<li data-target="#sampleCarousel" data-slide-to="{{$i}}"></li>
									@endif
								@endfor
							</ol>
							<div class="carousel-inner" role="listbox">
								@for($i=0;$i<count($tmp);$i++)
									@if($i==0)
										<div class="item active">
											<img src="/{{ $tmp[$i]['image_url']}}" alt="First slide">
										</div>
									@else
										<div class="item">
											<img src="/{{ $tmp[$i]['image_url']}}" alt="First slide">
										</div>
									@endif
								@endfor
							</div>
							<a class="left carousel-control" href="#sampleCarousel" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">前へ</span>
							</a>
							<a class="right carousel-control" href="#sampleCarousel" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">次へ</span>
							</a>
						</div>
					</div>
		@endif

			<!-- books -->
			@if (count($books) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						書籍一覧
					</div>

					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped task-table">
								<thead>
									<th>books</th>
									<th>&nbsp;</th>
								</thead>
								<tbody>
									@foreach ($books as $book)
										<tr>
											<td class="table-text"><div>{{$book->title}}</div></td>
							        <td>
								        @if($book->image_url)
								        <img class="mylist" src ="/{{ $book->image_url }}">
								        @endif
							        </td>
											<td>
												<form action="{{action('Controller@remove',$book)}}" method="POST">
													{{csrf_field()}}
													<inputy type="hidden" id="bookid" name="bookid" value="{{$book->id}}">
													<button type="submit" class="btn btn-danger">
														<i class="fa fa-trash"></i>削除
													</button>
												</form>
												<a class="btn btn-primary" href="{{action('Controller@detail',$book)}}" role="button">詳細</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>



	<!-- モーダルダイアログ -->
	<div class="modal fade" id="demoNormalModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="demoModalTitle">タイトル</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                内容・・・
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
	                <button type="button" class="btn btn-primary">ボタン</button>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
