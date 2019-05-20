@extends('layouts.app')

@section('content')
	<style>
		img {
		    max-width: 100%;
		    height: auto;
		}
	</style>
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ $book->title }}
					</div>

					<div class="panel-body">
						<div class="table-responsive">
							<div class="container-fluid">
							  <div class="row">
							    <div class="col no-gutters">
										@if ($book->image_url)
							      	<img class="img-fluid" src="/{{$book->image_url}}">
										@endif
							    </div>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<form action="{{ action('Controller@store', $book) }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					<input type="hidden" name="commentid" value="{{$book->id}}">
					<div class="form-group">
						<label for="task-name" class="col-sm-3 control-label">コメント</label>
						<div class="col-sm-6">
							<input type="text" name="comment" id="comment-name" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" class="btn btn-default">
								<i class="fa fa-plus"></i>コメント追加
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- </div> -->

		<!-- books -->
		<div class="container">
			@if (count($book->comments) > 0)
			<div class="col-sm-offset-2 col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ $book->title }}
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped task-table">

								<tbody>
									@foreach ($book->comments as $comment)
										<tr>
											<td class="table-text" colspan="5">
												<div>{{$comment->comment}}</div>
											</td>
											<td colspan="3">
												<a class="btn btn-primary" href="{{action('Controller@commentDelete',$comment)}}" role="button">削除</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
@endsection
