@extends('adminpanel.template')
@section('content')
<h2>Users (3)</h2>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Password</th>
			<th>Role</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>John</td>
			<td>John</td>
			<td>Doe</td>
			<td>das</td>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-primary">View or Edit</button>
					<button type="button" class="btn btn-danger">Delete</button>
				</div>
			</td>
		</tr>
	</tbody>
</table>
@stop