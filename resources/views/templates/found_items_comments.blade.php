<div class="commentcontainer cc{{ $comment->id }}">
	<div class="post_comments_left" style="background-image: url('{{ $comment->user->image }}');"></div>
	<div class="post_comments_right">
		<p class="comment">
			<a href="/user/{{ $comment->user_id }}" class="name">{{ $comment->user->name }} </a> <span class="comment_date">&#9679; {{ $comment->created_at->diffForHumans() }}</span>
			@if($comment->user_id == session('id') || session('role') == 'admin' || session('role') == 'superadmin')
			<a href="javascript:void(0);" class="deletelink" data-type="found" data-itemID="{{ $comment->found_item_id }}" data-commentID="{{ $comment->id }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
			@endif
			<span class="comment_content">
				{{ $comment->comment }}
			</span>
		</p>
	</div>
</div>