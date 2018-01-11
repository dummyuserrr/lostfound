@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		<div class="left">
			<div class="box">
				<div class="header">Conversations ({{ $myParticipations->count()}})</div>
				<div class="conversations_container">
					@if($myParticipations->count() > 0)
						@foreach($myParticipations as $myParticipation)
							<a href="javascript:;" class="@if($myParticipation->conversation->participations()->where('user_id', '!=', session('id'))->first()->id == $user->id) active @endif">{{ $myParticipation->conversation->participations()->where('user_id', '!=', session('id'))->first()->name }}</a>
						@endforeach
					@endif
				</div>
			</div>
		</div>
		<div class="right">
			@if(!session()->has('status'))
			<div class="box">
				<p class="prompt">Error. Please <a class="btnLogin" href="javascript:;">LOGIN</a> or <a href="javascript:;" class="btnRegister">REGISTER</a> to proceed.</p>
			</div>
			@else
			<div class="box">
				<div class="header">
					John Doe
				</div>
				<div class="messages_container">
					@if(count($myParticipations) < 1)
					You have no conversation
					@else
					<div class="mymessage">
						<p><b>You:</b> gago</p>
					</div>
					<div class="theirmessage">
						<p><b>John Doe:</b> tangina mo. You are currently employed and/or have a stable source of income, such as your own business. You are currently employed and/or have a stable source of income, such as your own business . You are currently employed and/or have a stable source of income, such as your own business. You are currently employed and/or have a stable source of income, such as your own business</p>
					</div>
					@endif
				</div>
				<div class="message_form">
					<form method="post" action="/messages/1">
						{{ csrf_field() }}
						<textarea rows="3" placeholder="Enter your message here ..." name="message" autofocus="on"></textarea>
						<button>Send Message</button>
					</form>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
@stop