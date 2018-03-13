@extends('adminpanel.template')
@section('content')
<h2>Edit User</h2>
@include('prompts.validation_errors')
@include('prompts.success')
<form action="/user/{{ $user->id }}/edit" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<div class="form-group">
		<label for="name">Name:</label>
		<input value="{{ $user->name }}" type="name" class="form-control" id="name" placeholder="Enter name" name="name" required>
	</div>
	<div class="form-group">
		<label for="email">Email address:</label>
		<input value="{{ $user->email }}" type="email" class="form-control" name="email" id="email" placeholder="Enter email address" required>
	</div>
	<div class="form-group">
		<label for="number">Number:</label>
		<input value="{{ $user->mobile }}" type="text" class="form-control" id="number" placeholder="Enter number" name="mobile" required>
	</div>
	<div class="form-group">
		<label for="address">Address:</label>
		<input value="{{ $user->address }}" type="address" class="form-control" id="address" placeholder="Enter address" name="address" required>
	</div>
	<div class="form-group">
		<label for="username">Username:</label>
		<input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="{{ $user->username }}" required>
	</div>
	<div class="form-group">
		<label for="pwd">Password: (Optional. You can leave this blank)</label>
		<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
	</div>
	<div class="form-group">
		<label for="pwd2">Retype Password: (Optional. You can leave this blank)</label>
		<input type="password" class="form-control" id="pwd2" placeholder="Retype password" name="password2">
	</div>
	<div class="form-group">
		<label for="image">Photo: (Optional. You can leave this blank)</label>
		<input type="file" class="form-control" id="image" name="image"><br>
		<img alt="Image Preview Here" src="/{{ $user->image }}" class="postimgpreview" style="max-width: 100%;">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>

<script type="text/javascript">
	$("#image").change(function(){
	    readURL(this);
	});

	function readURL(input) {
	    if(input.files && input.files[0]){
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('.postimgpreview').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
</script>
@stop