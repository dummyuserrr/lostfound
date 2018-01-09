@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		<div class="left">
			<div class="box">
				Left panel under construction
			</div>
		</div>
		<div class="right">
			@if(!session()->has('status'))
			<div class="box">
				<p class="prompt">You need to <a class="btnLogin" href="javascript:;">LOGIN</a> or <a href="javascript:;" class="btnRegister">REGISTER</a> to post your lost item</p>
			</div>
			@else
			<div class="box">
				<div class="header">
					POST YOUR LOST ITEM:
					<button class="toggle postToggler"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
				</div>
				<form method="post" action="/lost-something/add" enctype="multipart/form-data" class="form">
					{{ csrf_field() }}
					@include('prompts.validation_errors')
					<div class="column">
						<div class="form_group">
							<label>Item Name: <i>*</i></label>
							<input required type="text" name="name" autofocus>
						</div>
					</div>
					<div class="column">
						<div class="form_group">
							<label>Date Lost: <i>*</i></label>
							<input required type="date" name="datelost" style="padding: 5px;" max="{{ date('Y-m-d') }}">
						</div>
					</div>
					<div class="column">
						<div class="form_group">
							<label>Category: <i>*</i></label>
							<select name="category" required>
								<option selected disabled>Select Category</option>
								<option>Gadget</option>
								<option>Document</option>
								<option>ID</option>
								<option>Person</option>
								<option>Others</option>
							</select>
						</div>
					</div>
					<div class="column">
						<div class="form_group">
							<label>Photo/s (You can upload multiple): <i>*</i></label>
							<input required type="file" name="images[]" multiple>
						</div>
					</div>
					<div class="form_group">
						<label>Place Where You Lost It: <i>*</i></label>
						<input required type="text" name="place">
					</div>
					<div class="form_group">
						<label>Other Details: <i>*</i></label>
						<textarea name="otherdetails" rows="4" required></textarea>
					</div>
					<div class="form_group" style="text-align: left; margin-top: -10px;">
						<button style="max-width: 100px; font-size: 14px;">Post</button>
					</div>
				</form>
			</div>
			@endif
			<p class="mini_title">Lost Items by Other People</p>
			@foreach($lostItems as $l)
			<div class="box">
				@if($l->user_id == session('id') || session('role') == 'admin' || session('role') == 'superadmin')
				<div class="deletebutton" title="Delete this post" onclick="setDeleteTarget('{{ $l->id }}')">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</div>
				@endif
				<div class="posts">
					<div class="left">
						<div class="content">
							@if($l->images)
							<img src="/{{ $l->images->first()->image }}" class="post_photos" onclick="viewImage('/{{ $l->images->first()->image }}')">
							@else
							<p class="prompt">
								No Image(s) Uploaded
							</p>
							@endif
						</div>
					</div>
					<div class="right">
						<!-- <p class="texts"><span class="found"><i class="fa fa-check" aria-hidden="true"></i> This has been marked as found</span></p> -->
						<p class="texts">
							<span class="label">Item Name: </span>
							<span class="name">{{ $l->name }}</span>
						</p>
						<p class="texts">
							<span class="label">Category: </span>
							<span class="name">{{ $l->category }}</span>
						</p>
						<p class="texts">
							<span class="label">Last Place Seen: </span>
							<span class="name">{{ $l->place }}</span>
						</p>
						<p class="texts">
							<span class="label">Date Lost: </span>
							<span class="name">{{ $l->datelost }}</span>
						</p>
						<p class="texts">
							<span class="label">Other Details: </span>
							<span class="name">{{ $l->otherdetails }}</span>
						</p>
						<p class="texts">
							<span class="label">Posted by: </span>
							<span class="name">{{ $l->user->name }}</span>
						</p>
						<p class="texts">
							<span class="label">Posted On: </span>
							<span class="name">{{ $l->created_at->format('M d, Y - h:i:s A') }}</span>
						</p>
						@if($l->images->count() > 1)
						<p class="texts">
							<span class="label">Other Photos:</span>
						</p>
						<div class="post_photos_container">
							@foreach($l->images as $image)
							@if ($loop->first) @continue @endif
							<div class="boxes">
								<div class="post_photos morephotos" style="background-image: url('/{{ $image->image }}');" onclick="viewImage('/{{ $image->image }}')"></div>
							</div>
							@endforeach
						</div>
						@endif
					</div>
					<hr>
					<p class="minititle postcomments_toggler"><a href="javascript:;">VIEW {{ $l->comments->count() }} COMMENT(S) <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
					<div class="post_comments">
						@if(session()->has('status'))
						<div class="commentbox">
							<form method="post" action="/lost-something/{{ $l->id }}/comment/add" class="comment_form">
								{{ csrf_field() }}
								<textarea name="comment" rows="3" placeholder="Add a comment..." required></textarea>
								<button type="submit" class="comment_submit_button">Submit</button>
							</form>
						</div>
						@else
						<p class="prompt">You need to <a class="btnLogin" href="javascript:;">LOGIN</a> or <a href="javascript:;" class="btnRegister">REGISTER</a> to post your lost item</p>
						@endif
						<div class="comments_holder">
							@foreach($l->comments()->orderBy('created_at', 'desc')->get() as $comment)
							<div class="commentcontainer cc{{ $comment->id }}">
								<div class="post_comments_left" style="background-image: url('{{ $comment->user->image }}');"></div>
								<div class="post_comments_right">
									<p class="comment">
										<a href="#!" class="name">{{ $comment->user->name }} </a> <span class="comment_date">&#9679; {{ $comment->created_at->diffForHumans() }}</span>
										@if($comment->user_id == session('id') || session('role') == 'admin' || session('role') == 'superadmin')
										<a href="javascript:;" class="deletelink" onclick="setCommentDeleteTarget('{{ $comment->lost_item_id }}', '{{ $comment->id }}')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
										@endif
										<span class="comment_content">
											{{ $comment->comment }}
										</span>
									</p>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@stop