@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		<div class="right" style="width: 100%;">
			@if(!session()->has('status'))
			<div class="box">
				<p class="prompt">Error. Please <a class="btnLogin" href="javascript:void(0);">LOGIN</a> or <a href="javascript:void(0);" class="btnRegister">REGISTER</a> to proceed.</p>
			</div>
			@else
			<div class="box">
				<div class="header">
					missingZ Notifications
				</div>
				<div class="messages_container" style="min-height: 64vh;">
					@if($notifications->count() > 0)
						@foreach($notifications as $n)
							<div class="theirmessage">
								<p><b>{{ $n->created_at->diffForHumans() }}</b> {{ $n->body }}
									@if($n->url)
									<a href="{{ $n->url }}" style="color:#f99292; float: right;" target="_blank">Visit <i class="fa fa-external-link" aria-hidden="true"></i></a>
									@endif
								</p>
							</div>
						@endforeach
					@else
						You have no notifications
					@endif
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
@stop