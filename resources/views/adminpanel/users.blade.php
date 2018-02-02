@extends('adminpanel.template')
@section('content')
<h2>Users (3)</h2>
<button type="button" class="btn btn-primary">Add Admin User</button>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Role</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td>{{ $user->name }}</td>
			<td>{{ $user->username }}</td>
			<td>{{ $user->role }}</td>
			<td>
				<div class="btn-group">
					<a type="button" href="/users/{{ $user->id }}/edit" target="_blank" class="btn btn-primary">View or Edit</a>
					<button type="button" class="btn btn-danger" data-target="#deleteModal" data-toggle="modal">Delete</button>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this user?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<form method="post" action="" id="formDelete">
	{{ csrf_field() }}
	{{ method_field('delete') }}
</form>
@stop