@extends('adminpanel.template')
@section('content')
<h2>Add Admin User</h2>
@include('prompts.validation_errors')
<form action="/admin-panel/users/new" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name">Name:</label>
		<input type="name" class="form-control" id="name" placeholder="Enter name" name="name" required>
	</div>
	<div class="form-group">
		<label for="email">Email address:</label>
		<input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" required>
	</div>
	<div class="form-group">
		<label for="number">Number:</label>
		<input type="text" class="form-control" id="number" placeholder="Enter number" name="mobile" required>
	</div>
	<div class="form-group">
		<label for="address">Address:</label>
		<input type="address" class="form-control" id="address" placeholder="Enter address" name="address" required>
	</div>
	<div class="form-group">
		<label for="username">Username:</label>
		<input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
	</div>
	<div class="form-group">
		<label for="pwd">Password:</label>
		<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
	</div>
	<div class="form-group">
		<label for="pwd2">Retype Password:</label>
		<input type="password" class="form-control" id="pwd2" placeholder="Retype password" name="password2" required>
	</div>
	<div class="form-group">
		<label for="image">Photo:</label>
		<input type="file" class="form-control" id="image" name="image" required>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
@stop