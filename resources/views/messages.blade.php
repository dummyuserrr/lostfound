@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		@include('templates.lost_items_left')
		<div class="right">
			@if(!session()->has('status'))
			<div class="box">
				<p class="prompt">Error. Please <a class="btnLogin" href="javascript:;">LOGIN</a> or <a href="javascript:;" class="btnRegister">REGISTER</a> to proceed.</p>
			</div>
			@else
			<div class="box">
				<div class="header">
					POST YOUR LOST ITEM:
					<button class="toggle postToggler"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
@stop