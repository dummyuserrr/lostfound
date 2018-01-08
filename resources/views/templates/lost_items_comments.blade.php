<div class="commentcontainer">
	<div class="post_comments_left" style="background-image: url('{{ $comment->user->image }}');"></div>
	<div class="post_comments_right">
		<p class="comment">
			<a href="#!" class="name">{{ $comment->user->name }} </a> <span class="comment_date">&#9679; {{ $comment->created_at->diffForHumans() }}</span>
			<span class="comment_content">
				{{ $comment->comment }}
			</span>
		</p>
	</div>
</div>