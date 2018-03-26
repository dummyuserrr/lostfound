@extends('templates.template')
@section('content')
<div class="home_banner">
	<div class="overlayer">
		<div class="container">
			<div class="table">
				<div class="content">
					<p class="title">
						Lost and Found Monitoring and Management System for People of Pangasinan
					</p>
					<div class="columns">
						<a href="/lost-something" class="lost"><i class="fa fa-frown-o" aria-hidden="true"></i> LOST SOMETHING</a>
					</div>
					<div class="columns">
						<a href="/found-something" class="found"><i class="fa fa-smile-o" aria-hidden="true"></i> FOUND SOMETHING</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="how_it_works">
	<div class="container">
		<p class="big"><i class="fa fa-address-book-o" aria-hidden="true"></i></p>
		<p class="title">About Us</p>
		<p class="description">To ensure every item of lost property is matched and sent back to its lawful owner as quickly and as efficiently as possible. Create an innovative and constantly evolving online ecosystem to enable losers of property to be matched to finders of property for free.</p>
	</div>
</div>
<hr>
<div class="how_it_works">
	<div class="container contact-us-container">
		<p class="big"><i class="fa fa-envelope" aria-hidden="true"></i></p>
		<p class="title">Message Us</p>
		<div class="form">
			<form method="post" action="/submit-message" id="messageUs">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Name:</label>
					<input required type="text" name="name">
				</div>
				<div class="form-group">
					<label>Email:</label>
					<input required type="email" name="email">
				</div>
				<div class="form-group">
					<label>Number:</label>
					<input required type="text" name="number">
				</div>
				<div class="form-group">
					<label>Message:</label>
					<textarea required type="text" name="message" rows="5"></textarea>
				</div>
				<div class="form-group">
					<button>Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop