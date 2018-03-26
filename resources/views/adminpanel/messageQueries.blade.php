@extends('adminpanel.template')
@section('content')
<h2>Message Queries ({{ $mqs->count() }})</h2>
@if(session('role') == 'superadmin')
<a type="button" class="btn btn-primary" href="/admin-panel/users/new">Add Admin User</a>
@endif
<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Number</th>
			<th>Message</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($mqs as $mq)
		<tr>
			<td>{{ $mq->name }}</td>
			<td>{{ $mq->email }}</td>
			<td>{{ $mq->number }}</td>
			<td>{{ $mq->message }}</td>
			@if(session('role') == 'superadmin')
			<td>
				<div class="btn-group">
					<button type="button" class="btndelete btn btn-danger" data-target="#deleteModal" data-toggle="modal" data-url="/admin-panel/message-queries/{{ $mq->id }}/delete">Delete</button>
				</div>
			</td>
			@endif
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
				<p>Are you sure you want to delete this item?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="initiateDelete btn btn-danger" data-dismiss="modal">Yes</button>
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