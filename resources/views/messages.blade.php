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
					{{ $user->name }}
				</div>
				<div class="messages_container">
					@if(count($messages) < 1 || empty($messages))
					You have no conversation
					@else
						@foreach($messages as $message)
							@if($message->user_id == session('id'))
								<div class="mymessage">
									<p><b>You:</b> {{ $message->body }}</p>
								</div>
							@else
								<div class="theirmessage">
									<p><b>{{ $message->user->name }}:</b> {{ $message->body }}</p>
								</div>
							@endif
						@endforeach
					@endif
				</div>
				<div class="message_form">
					@if(empty($conversation))
					<form method="post" action="/messages/0/{{ $user->id }}">
					@else
					<form method="post" action="/messages/{{ $conversation->id }}/{{ $user->id }}">
					@endif
						{{ csrf_field() }}
						<textarea rows="3" required placeholder="Enter your message here ..." name="message" autofocus="on"></textarea>
						<button type="submit">Send Message</button>
					</form>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
@stop