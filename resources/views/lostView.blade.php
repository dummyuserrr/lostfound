@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		@include('templates.lost_items_left')
		<div class="right">
			<div class="grouper">
				<div class="box">
					@if($item->user_id == session('id') || session('role') == 'admin' || session('role') == 'superadmin')
					<div class="markAsFound" data-type="lost" title="Mark as Retrieved" data-itemID="{{ $item->id }}">
						<i class="fa fa-check-circle-o" aria-hidden="true"></i>
					</div>
					<div class="deletebutton" title="Delete this post" onclick="setDeleteTarget('{{ $item->id }}')">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</div>
					@endif
					<div class="posts">
						<div class="left">
							<div class="content">
								@if($item->images->count() > 0)
								<img src="/{{ $item->images->first()->image }}" title="Click to view photo" class="post_photos" onclick="viewImage('/{{ $item->images->first()->image }}')">
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
								<span class="name">{{ $item->name }}</span>
							</p>
							<p class="texts">
								<span class="label">Category: </span>
								<span class="name">{{ $item->category }}</span>
							</p>
							<p class="texts">
								<span class="label">Last Place Seen: </span>
								<span class="name">{{ $item->place }}</span>
							</p>
							<p class="texts">
								<span class="label">Date Lost: </span>
								<span class="name">{{ $item->datelost }}</span>
							</p>
							<p class="texts">
								<span class="label">Time Lost: </span>
								<span class="name">{{ date('g:i A', strtotime($item->timelost)) }}</span>
							</p>
							<p class="texts">
								<span class="label">Other Details: </span>
								<span class="name">{{ $item->otherdetails }}</span>
							</p>
							<p class="texts">
								<span class="label">Posted by: </span>
								@if($item->user)
								<span class="name"><a href="/user/{{ $item->user_id }}"><b>{{ $item->user->name }}</b></a></span>
								@else
								User has been deleted
								@endif
							</p>
							<p class="texts">
								<span class="label">Posted On: </span>
								<span class="name">{{ $item->created_at->format('M d, Y - h:i:s A') }}</span>
							</p>
							@if($item->images->count() > 1)
							<p class="texts">
								<span class="label">Other Photos:</span>
							</p>
							<div class="post_photos_container">
								@foreach($item->images as $image)
								@if ($itemoop->first) @continue @endif
								<div class="boxes">
									<div title="Click to view photo" class="post_photos morephotos" style="background-image: url('/{{ $image->image }}');" onclick="viewImage('/{{ $image->image }}')"></div>
								</div>
								@endforeach
							</div>
							@endif
						</div>
						<hr>
						<p class="minititle postcomments_toggler"><a href="javascript:void(0);">VIEW {{ $item->comments->count() }} COMMENT(S) <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
						<div class="post_comments">
							@if(session()->has('status'))
							<div class="commentbox">
								<form method="post" action="/lost-something/{{ $item->id }}/comment/add" class="comment_form">
									{{ csrf_field() }}
									<textarea name="comment" rows="3" placeholder="Add a comment..." required></textarea>
									<button type="submit" class="comment_submit_button">Submit</button>
								</form>
							</div>
							@else
							<p class="prompt">You need to <a class="btnLogin" href="javascript:void(0);">LOGIN</a> or <a href="javascript:void(0);" class="btnRegister">REGISTER</a> to post a comment</p>
							@endif
							<div class="comments_holder">
								@foreach($item->comments()->orderBy('created_at', 'desc')->get() as $comment)
								<div class="commentcontainer cc{{ $comment->id }}">
									<div class="post_comments_left" style="background-image: url('{{ $comment->user->image }}');"></div>
									<div class="post_comments_right">
										<p class="comment">
											<a href="/user/{{ $comment->user_id }}" class="name">{{ $comment->user->name }} </a> <span class="comment_date">&#9679; {{ $comment->created_at->diffForHumans() }}</span>
											@if($comment->user_id == session('id') || session('role') == 'admin' || session('role') == 'superadmin')
											<a href="javascript:void(0);" class="deletelink" data-itemID="{{ $comment->lost_item_id }}" data-commentID="{{ $comment->id }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
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
			</div>
		</div>
	</div>
</div>
@stop