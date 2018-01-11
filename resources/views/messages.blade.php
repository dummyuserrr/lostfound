@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		<div class="left">
			<div class="box">
				<div class="header">Conversations</div>
				<div class="conversations_container">
					<a href="javascript:;" class="active">John Doe</a>
					<a href="javascript:;">John Doe</a>
					<a href="javascript:;">John Doe</a>
					<a href="javascript:;">John Doe</a>
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
					You have no conversation
				</div>
				<div class="message_form">
					<form>
						<textarea rows="3" placeholder="Enter your message here ..."></textarea>
						<button>Send Message</button>
					</form>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
@stop