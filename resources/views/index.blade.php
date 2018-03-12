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
		<p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
</div>
@stop