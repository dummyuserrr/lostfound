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
						<button style="max-width: 300px; font-size: 14px; padding: 10px;">Send a message</button>
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
		</div>
	</div>
</div>
@stop