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
@stop