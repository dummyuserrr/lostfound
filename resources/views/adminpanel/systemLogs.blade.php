@extends('adminpanel.template')
@section('content')
<h2>System Logs ({{ $logs->count() }})</h2>
<ul class="nav nav-pills">
	<li class="active"><a data-toggle="pill" href="#systemLogs">System Logs/Database</a></li>
	<li><a href="http://localhost/phpMyAdmin" target="_blank">Open Database <i class="fa fa-external-link" aria-hidden="true"></i></a></li>
</ul>
<br>
		<table class="table table-striped">
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
					<td>{{ $log->created_at }} &bull; {{ $log->created_at->diffForHumans() }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
@stop