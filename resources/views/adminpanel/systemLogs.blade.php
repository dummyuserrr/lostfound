@extends('adminpanel.template')
@section('content')
<h2>System Logs ({{ $logs->count() }})</h2>
<ul>
	@foreach($logs as $log)
		<li><h5>{{ $log->body }} <small>{{ $log->created_at }}</small></h5></li>
	@endforeach
</ul>
@stop