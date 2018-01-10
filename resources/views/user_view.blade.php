@extends('templates.template')
@section('content')
<div class="user_view_container">
	<div class="container">
		<div class="left">
			<div class="box">
				<div class="header">
					ACTIONS
				</div>
				<div class="body">
					<form method="get" action="/lost-something/search">
						<div class="form_group">
							<label>Query: </label>
							<input type="text" name="q" placeholder="Search" value="@if(!empty($q)){{ $q }}@endif">
						</div>
						<div class="form_group">
							<label>Category: </label>
							<select name="category">
								@if(empty($categorySelected))
								<option selected>All</option>
								<option>Gadget</option>
								<option>License (ID, Passport, etc)</option>
								<option>Pet</option>
								<option>Jewelry</option>
								<option>Person</option>
								<option>Others</option>
								@else
								<option @if($categorySelected == 'All') selected @endif>All</option>
								<option @if($categorySelected == 'Gadget') selected @endif>Gadget</option>
								<option @if($categorySelected == 'License (ID, Passport, etc)') selected @endif>License (ID, Passport, etc)</option>
								<option @if($categorySelected == 'Pet') selected @endif>Pet</option>
								<option @if($categorySelected == 'Jewelry') selected @endif>Jewelry</option>
								<option @if($categorySelected == 'Person') selected @endif>Person</option>
								<option @if($categorySelected == 'Others') selected @endif>Others</option>
								@endif
							</select>
						</div>
						<div class="form_group">
							<button type="submit" style="max-width: 100px; font-size: 14px;">Search</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="right">
			<div class="box">
				<p class="prompt">You need to <a class="btnLogin" href="javascript:;">LOGIN</a> or <a href="javascript:;" class="btnRegister">REGISTER</a> to post your lost item</p>
			</div>
			<div class="box">
				<div class="userprofile">
					<img src="{{ $user->image }}" class="image">
					<div class="form_group">
						<label>Name:</label>
						<input required type="text" disabled name="name" value="{{ $user->name }}">
					</div>
					<div class="form_group">
						<label>Address:</label>
						<input required type="text" disabled name="address" value="{{ $user->address }}">
					</div>
					<div class="form_group">
						<label>Email:</label>
						<input required type="text" disabled name="email" value="{{ $user->email }}">
					</div>
					<div class="form_group">
						<label>Mobile:</label>
						<input required type="text" disabled name="mobile" value="{{ $user->mobile }}">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop