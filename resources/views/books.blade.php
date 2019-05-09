@extends('layouts.app')

@section('content')
	<style>
		img{
		  background-color: gray;
		  width: 70px; height: 70px;
		  object-fit: contain;
		}
	</style>
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
							</div>
						</div>
					</form>
				</div>
			</div>

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
								        <img src ="/{{ $book->image_url }}">
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
@endsection
