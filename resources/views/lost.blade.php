@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		<div class="left">
			<div class="box">
				sadsa
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
					<div class="form_group">
						<label>Item Name: <i>*</i></label>
						<input required type="text" name="name" autofocus>
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
			<div class="box">
				<div class="posts">
					<div class="left">
						<div class="content">
							<img src="/img/sample_lost.jpg" class="post_photos" onclick="viewImage()">
							<!-- <p class="prompt">
										No Image(s) Uploaded
							</p> -->
						</div>
					</div>
					<div class="right">
						<!-- <p class="texts"><span class="found"><i class="fa fa-check" aria-hidden="true"></i> This has been marked as found</span></p> -->
						<p class="texts">
							<span class="label">Item Name: </span>
							<span class="name">iPhone 6s</span>
						</p>
						<p class="texts">
							<span class="label">Category: </span>
							<span class="name">Phone</span>
						</p>
						<p class="texts">
							<span class="label">Last Place Seen: </span>
							<span class="name">CSI Lucao</span>
						</p>
						<p class="texts">
							<span class="label">Other Details: </span>
							<span class="name">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </span>
						</p>
						<p class="texts">
							<span class="label">Posted by: </span>
							<span class="name">Jane Doe</span>
						</p>
						<p class="texts">
							<span class="label">Posted On: </span>
							<span class="name">January 5, 2018</span>
						</p>
						<p class="texts">
							<span class="label">Other Photos:</span>
						</p>
						<div class="post_photos_container">
							<div class="boxes">
								<div class="post_photos morephotos" style="background-image: url('/img/sample_lost.jpg');"></div>
							</div>
						</div>
					</div>
					<hr>
					<p class="minititle postcomments_toggler"><a href="javascript:;">VIEW 2 COMMENT(S) <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
					<div class="post_comments">
						@if(session()->has('status'))
						<div class="commentbox">
							<form method="post" action="/lost/comment/add">
								{{ csrf_field() }}
								<textarea name="comment" rows="3" placeholder="Add a comment..." required></textarea>
								<button type="submit">Submit</button>
							</form>
						</div>
						@else
						<p class="prompt">You need to <a class="btnLogin" href="javascript:;">LOGIN</a> or <a href="javascript:;" class="btnRegister">REGISTER</a> to post your lost item</p>
						@endif
						<div class="commentcontainer">
							<div class="post_comments_left" style="background-image: url('/img/sample_lost.jpg');"></div>
							<div class="post_comments_right">
								<p class="comment">
									<a href="#!" class="name">John Doe <span class="comment_date">&#9679; 1 min ago</span></a>
									<span class="comment_content">
										Nakita ko to kahapon ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris n
									</span>
								</p>
							</div>
						</div>
						<div class="commentcontainer">
							<div class="post_comments_left" style="background-image: url('/img/sample_lost.jpg');"></div>
							<div class="post_comments_right">
								<p class="comment">
									<a href="#!" class="name">John Doe <span class="comment_date">&#9679; 1 min ago</span></a>
									<span class="comment_content">
										Nakita ko to kahapon ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris n
									</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop