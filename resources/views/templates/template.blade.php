<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf_token" content="{{ csrf_token() }}">
		<title>Lost and Found</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
		<link rel="stylesheet" type="text/css" href="/css/owl.theme.default.min.css">
		<link rel="stylesheet" type="text/css" href="/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/less" href="/css/custom.less">
		<script type="text/javascript" src="/js/less.min.js"></script>
	</head>
	<body>
		<nav>
			<div class="top">
				<div class="container">
					<div class="options btnRegister"><i class="fa fa-user" aria-hidden="true"></i> Register</div>
					<div class="options btnLogin"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</div>
				</div>
			</div>
			<div class="bottom">
				<div class="container">
					<div class="left">
						<a href="/" class="title"><i class="fa fa-tags" aria-hidden="true"></i> TITLE DITO</a>
					</div>
					<div class="right">
						@if(checkCurrentDirectory('/') != 'true')
						<p><a href="/lost" class="{{ navSetActive('lost') }}">LOST SOMETHING</a></p>
						<p><a href="/found" class="{{ navSetActive('found') }}">FOUND SOMETHING</a></p>
						@endif
						<p>Total found items: <span>999,999</span></p>
					</div>
				</div>
			</div>
		</nav>
		<div class="content_container">
			@yield('content')
		</div>
		<div class="footer">
			<div class="container">
				&copy; Copyright 2018. All Rights Reserved.
			</div>
		</div>
		<div class="mymodal registerModal">
			<div class="modal">
				<button class="modal-closer"><i class="fa fa-times" aria-hidden="true"></i></button>
				<div class="header">Register</div>
				<div class="body">
					<form method="post" action="/register">
						<div class="form_group">
							<label>Name: <i>*</i></label>
							<input required type="text" name="name" placeholder="John Doe" id="register_name">
						</div>
						<div class="column">
							<div class="form_group">
								<label>Email: <i>*</i></label>
								<input required type="email" name="email" placeholder="johndoe@email.com">
							</div>
						</div>
						<div class="column">
							<div class="form_group">
								<label>Mobile Number: <i>*</i></label>
								<input required type="text" name="mobile" placeholder="09991234567">
							</div>
						</div>
						<div class="form_group">
							<label>Address: <i>*</i></label>
							<input required type="text" name="address" placeholder="43, Amado St., Dagupan City, Pangasinan">
						</div>
						<div class="form_group">
							<label>Username: <i>*</i></label>
							<input required type="text" name="username" placeholder="johndoe">
						</div>
						<div class="column">
							<div class="form_group">
								<label>Password: <i>*</i></label>
								<input required type="password" placeholder="Password" name="password">
							</div>
						</div>
						<div class="column">
							<div class="form_group">
								<label>Re-enter Password: <i>*</i></label>
								<input required type="password" placeholder="Password" name="password2">
							</div>
						</div>
						<div class="form_group">
							<label for="photo">Photo: <i>*</i></label>
							<input required id="photo" type="file" name="image">
						</div>
						<div class="form_group">
							<button type="submit">Register</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="mymodal loginModal">
			<div class="modal">
				<button class="modal-closer"><i class="fa fa-times" aria-hidden="true"></i></button>
				<div class="header">User Login</div>
				<div class="body">
					<form method="post" action="/login">
						{{ csrf_field() }}
						<div class="form_group">
							<label>Username: <i>*</i></label>
							<input required type="text" name="username" autocomplete="off">
						</div>
						<div class="form_group">
							<label>Password: <i>*</i></label>
							<input required type="password" name="password" autocomplete="off">
						</div>
						<div class="form_group">
							<button type="submit">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="mymodal photoModal">
			<div class="modal">
				<button class="modal-closer"><i class="fa fa-times" aria-hidden="true"></i></button>
				<div class="header">Image Preview</div>
				<div class="body">
					<img class="photoView" src="/img/sample_lost.jpg">
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="/js/owl.carousel.min.js"></script>
		<script type="text/javascript" src="/js/actions.js"></script>
	</body>
</html>