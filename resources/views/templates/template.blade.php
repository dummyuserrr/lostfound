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
					<a href="javascript:;" id="btnRegister"><i class="fa fa-user" aria-hidden="true"></i> Register</a>
					<a href="javascript:;" id="btnLogin"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
				</div>
			</div>
			<div class="bottom">
				<div class="container">
					<div class="left">
						<a href="/" class="title"><i class="fa fa-tags" aria-hidden="true"></i> TITLE DITO</a>
					</div>
					<div class="right">
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
				<button class="close"><i class="fa fa-times" aria-hidden="true"></i></button>
				<div class="header">Register</div>
				<div class="body">
					<form method="post" action="/register">
						<div class="form_group">
							<label>Name:</label>
							<input type="text" name="name">
						</div>
						<div class="column">
							<div class="form_group">
								<label>Email:</label>
								<input type="text" name="email">
							</div>
						</div>
						<div class="column">
							<div class="form_group">
								<label>Mobile Number:</label>
								<input type="text" name="mobile">
							</div>
						</div>
						<div class="form_group">
							<label>Address:</label>
							<input type="text" name="address">
						</div>
						<div class="form_group">
							<label>Username:</label>
							<input type="text" name="username">
						</div>
						<div class="column">
							<div class="form_group">
								<label>Password:</label>
								<input type="password" name="password">
							</div>
						</div>
						<div class="column">
							<div class="form_group">
								<label>Re-enter Password:</label>
								<input type="password" name="password2">
							</div>
						</div>
						<div class="form_group">
							<button type="submit">Register</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="/js/owl.carousel.min.js"></script>
		<script type="text/javascript" src="/js/actions.js"></script>
	</body>
</html>