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
				<div class="header" style="text-align: center;">
					Edit Account (Optional)
				</div>
				<div class="userprofile">
					@include('prompts.validation_errors')
					@include('prompts.success')
					<form method="post" action="/my-account" enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('patch') }}
						<div class="form_group">
							<label for="myaccount_image" style="cursor:pointer; text-align: center;">
								<img src="{{ $user->image }}" class="image myaccount_image" title="Click to edit image">
							</label>
							<input type="file" name="image" id="myaccount_image" style="display:none">
						</div>
						<div class="form_group">
							<label>Username:</label>
							<input required type="text" disabled value="{{ $user->username }}">
						</div>
						<div class="form_group">
							<label>New Password: (Optional. You can leave this blank)</label>
							<input type="password" name="password">
						</div>
						<div class="form_group">
							<label>Re-enter New Password:</label>
							<input type="password" name="password2">
						</div>
						<div class="form_group">
							<label>Name:</label>
							<input required type="text" name="name" value="{{ $user->name }}">
						</div>
						<div class="form_group">
							<label>Address:</label>
							<input required type="text" name="address" value="{{ $user->address }}">
						</div>
						<div class="form_group">
							<label>Email:</label>
							<input required type="text" name="email" value="{{ $user->email }}">
						</div>
						<div class="form_group">
							<label>Mobile:</label>
							<input required type="text" name="mobile" value="{{ $user->mobile }}">
						</div>
						<div class="form_group">
							<button>Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop