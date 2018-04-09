@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		@include('templates.retrieved_items_left')
		<div class="right">
			<p class="mini_title" style="margin-top: -5px;">Retrieved Items</p>
			@foreach($lostItems as $l)
			<div class="box">
				@if($l->user_id == session('id') || session('role') == 'admin' || session('role') == 'superadmin')
				<!-- <div class="deletebutton" title="Delete this post" onclick="setDeleteTarget('{{ $l->id }}')">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</div> -->
				@endif
				<div class="posts">
					<div class="left">
						<div class="content">
							@if($l->images->count() > 0)
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
							<span class="label">Marked As Retrieved On: </span>
							<span class="name">{{ $l->updated_at }}</span>
						</p>
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
							<span class="label">Time Lost: </span>
							<span class="name">{{ date('g:i A', strtotime($l->timelost)) }}</span>
						</p>
						<p class="texts">
							<span class="label">Other Details: </span>
							<span class="name">{{ $l->otherdetails }}</span>
						</p>
						<p class="texts">
							<span class="label">Posted by: </span>
							@if($l->user)
							<span class="name"><a href="/user/{{ $l->user_id }}"><b>{{ $l->user->name }}</b></a></span>
							@else
							User has been deleted
							@endif
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
				</div>
			</div>
			@endforeach
			@foreach($foundItems as $l)
			<div class="box">
				@if($l->user_id == session('id') || session('role') == 'admin' || session('role') == 'superadmin')
				<!-- <div class="deletebutton" title="Delete this post" onclick="setDeleteTarget_found('{{ $l->id }}')">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</div> -->
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
							<span class="label">Marked As Retrieved On: </span>
							<span class="name">{{ $l->updated_at }}</span>
						</p>
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
							<span class="label">Date Found: </span>
							<span class="name">{{ $l->datefound }}</span>
						</p>
						<p class="texts">
							<span class="label">Time Found: </span>
							<span class="name">{{ date('g:i A', strtotime($l->timefound)) }}</span>
						</p>
						<p class="texts">
							<span class="label">Other Details: </span>
							<span class="name">{{ $l->otherdetails }}</span>
						</p>
						<p class="texts">
							<span class="label">Posted by: </span>
							@if($l->user)
							<span class="name"><a href="/user/{{ $l->user_id }}"><b>{{ $l->user->name }}</b></a></span>
							@else
							User has been deleted
							@endif
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
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@stop