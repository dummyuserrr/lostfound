@extends('adminpanel.template')
@section('content')
<h2>System Logs ({{ $logs->count() }})</h2>
<ul class="nav nav-pills">
	<li class="active"><a data-toggle="pill" href="#systemLogs">System Logs/Database</a></li>
	<li><a data-toggle="pill" href="#users">Users</a></li>
	<li><a data-toggle="pill" href="#lostItems">Lost Items</a></li>
	<li><a data-toggle="pill" href="#lostItemComments">Lost Item Comments</a></li>
</ul>
<br>
<div class="tab-content">
	<div id="systemLogs" class="tab-pane fade in active">
		<table class="datatables table table-striped display">
			<thead>
				<tr>
					<th>Content</th>
					<th>Time</th>
				</tr>
			</thead>
			<tbody>
				@foreach($logs as $log)
				<tr>
					<td>{{ $log->body }}</td>
					<td>{{ $log->created_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div id="users" class="tab-pane fade">
		<table class="datatables table table-striped display">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Image Path</th>
					<th>Selfie Path</th>
					<th>Username</th>
					<th>Password</th>
					<th>Role</th>
					<th>Approved</th>
					<th>Created At</th>
					<th>Updated At</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->address }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->mobile }}</td>
					<td>{{ $user->image }}</td>
					<td>{{ $user->selfie }}</td>
					<td>{{ $user->username }}</td>
					<td>{{ $user->password }}</td>
					<td>{{ $user->role }}</td>
					<td>{{ $user->approved }}</td>
					<td>{{ $user->created_at }}</td>
					<td>{{ $user->updated_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div id="lostItems" class="tab-pane fade">
		<table class="datatables table table-striped display">
			<thead>
				<tr>
					<th>ID</th>
					<th>User ID</th>
					<th>Name</th>
					<th>Category</th>
					<th>Place</th>
					<th>Date Lost</th>
					<th>Time Lost</th>
					<th>Other Details</th>
					<th>Status</th>
					<th>Created At</th>
					<th>Updated At</th>
				</tr>
			</thead>
			<tbody>
				@foreach($lostItems as $li)
				<tr>
					<td>{{ $li->id }}</td>
					<td>{{ $li->user_id }}</td>
					<td>{{ $li->name }}</td>
					<td>{{ $li->category }}</td>
					<td>{{ $li->place }}</td>
					<td>{{ $li->datelost }}</td>
					<td>{{ $li->timelost }}</td>
					<td>{{ $li->otherdetails }}</td>
					<td>{{ $li->status }}</td>
					<td>{{ $li->created_at }}</td>
					<td>{{ $li->updated_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop