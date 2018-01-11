@extends('templates.template')
@section('content')
<div class="user_view_container">
	<div class="container">
		@if(session()->has('status') && session('id') != $user->id)
		<div class="left">
			<div class="box">
				<div class="header">
					ACTIONS
				</div>
				<div class="body">
					<div class="form_group">
						<button style="max-width: 300px; font-size: 14px; padding: 10px;" onclick="redirect('/messages/{{ $user->id }}')">Send a message</button>
					</div>
				</div>
			</div>
		</div>
		@endif
		<div class="right">
			<div class="box">
				<div class="userprofile">
					<img src="{{ $user->image }}" class="image">
					<div class="form_group">
						<label>Name:</label>
						<input required type="text" disabled name="name" value="{{ $user->name }}">
					</div>
					<div class="form_group">
						<label>Address:</label>
						<input required type="text" disabled name="address" value="{{ $user->address }}">
					</div>
					<div class="form_group">
						<label>Email:</label>
						<input required type="text" disabled name="email" value="{{ $user->email }}">
					</div>
					<div class="form_group">
						<label>Mobile:</label>
						<input required type="text" disabled name="mobile" value="{{ $user->mobile }}">
					</div>
				</div>
			</div>
			@if($user->lost_items()->where('status', 0)->orderBy('created_at', 'desc')->count() > 0)
			<p class="mini_title">Lost Items Posted by this User:</p>
			@endif
			@foreach($user->lost_items()->where('status', 0)->orderBy('created_at', 'desc')->get() as $l)
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
							<img src="/{{ $l->images->first()->image }}" title="Click to view photo" class="post_photos" onclick="viewImage('/{{ $l->images->first()->image }}')">
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
							<span class="name"><a href="/user/{{ $l->user_id }}"><b>{{ $l->user->name }}</b></a></span>
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
								<div title="Click to view photo" class="post_photos morephotos" style="background-image: url('/{{ $image->image }}');" onclick="viewImage('/{{ $image->image }}')"></div>
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
										<a href="/user/{{ $comment->user_id }}" class="name">{{ $comment->user->name }} </a> <span class="comment_date">&#9679; {{ $comment->created_at->diffForHumans() }}</span>
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