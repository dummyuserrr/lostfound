<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf_token" content="{{ csrf_token() }}">
		<title>missingZ</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
		<link rel="stylesheet" type="text/css" href="/css/owl.theme.default.min.css">
		<link rel="stylesheet" type="text/css" href="/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/tippyjs-master/dist/tippy.css">
		<link rel="stylesheet" type="text/less" href="/css/custom.less">
		<script type="text/javascript" src="/js/less.min.js"></script>
	</head>
	<body>
		<nav>
			<div class="top">
				<div class="container">
					@if(session()->has('status'))
					@if(session('role') == 'admin' || session('role') == 'superadmin')
					<div class="options btnAdminpanel"><i class="fa fa-lock" aria-hidden="true"></i> AdminPanel</div>
					@endif
					<div class="options btnMessages"><i class="fa fa-envelope" aria-hidden="true"></i> Messages {{ countUnreadMessages() }}</div>
					<div class="options btnMyAccount"><i class="fa fa-user" aria-hidden="true"></i> My Account</div>
					<div class="options btnLogout"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</div>
					<form id="frmLogout" method="post" action="/logout">
						{{ csrf_field() }}
					</form>
					@else
					<div class="options btnRegister"><i class="fa fa-user" aria-hidden="true"></i> Register</div>
					<div class="options btnLogin"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</div>
					@endif
				</div>
			</div>
			<div class="bottom">
				<div class="container">
					<div class="left">
						<a href="/" class="title"><img src="/img/icon.png"> missingZ</a>
					</div>
					<div class="right">
						@if(checkCurrentDirectory('/') != 'true')
						<p><a href="/lost-something" class="{{ navSetActive('lost') }}">LOST SOMETHING</a></p>
						<p><a href="/found-something" class="{{ navSetActive('found') }}">FOUND SOMETHING</a></p>
						@endif
						<p><a href="/retrieved-items" class="{{ navSetActive('retrieved-items') }}" style="font-size: 15px;">Total Retrieved Items: <span>3</span></a></p>
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
					@include('prompts.prompt_message')
					<form method="post" action="/register" enctype="multipart/form-data" id="registerForm">
						{{ csrf_field() }}
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
					<form method="post" action="/login" id="frmLogin">
						{{ csrf_field() }}
						<div class="form_group">
							<label>Username:</label>
							<input type="text" name="username" id="login_username" autofocus autocomplete="off">
						</div>
						<div class="form_group">
							<label>Password:</label>
							<input type="password" name="password" autocomplete="off">
						</div>
						<div class="form_group loginerror">
							<div class="prompt">Wrong username or password. Please try again.</div>
						</div>
						<div class="form_group">
							<button type="submit" class="loginbutton">Login</button>
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
		<div class="mymodal deleteModal">
			<div class="modal">
				<button class="modal-closer"><i class="fa fa-times" aria-hidden="true"></i></button>
				<div class="header">Warning</div>
				<div class="body">
					Are you sure you want to delete this item?
					<div class="form_group">
						<button onclick="initiateDelete()">Yes</button>
						<button style="background: #818181; border: 1px solid #818181;" onclick="closeModal()">No</button>
					</div>
				</div>
			</div>
		</div>
		<div class="mymodal markAsFoundModal">
			<div class="modal">
				<button class="modal-closer"><i class="fa fa-times" aria-hidden="true"></i></button>
				<div class="header">Confirmation</div>
				<div class="body">
					Are you sure that this item has been retrieved?
					<div class="form_group">
						<button onclick="initiateFound()" style="background-color: #1a5d1e; border: 1px solid #1a5d1e;">Yes</button>
						<button style="background: #818181; border: 1px solid #818181;" onclick="closeModal()">No</button>
					</div>
				</div>
			</div>
		</div>
		@if(session()->has('status'))
		<form id="deleteForm" method="post" action="none">
			{{ csrf_field() }}
			{{ method_field('delete') }}
		</form>
		<form id="deleteFormComment" method="post" action="none">
			{{ csrf_field() }}
			{{ method_field('delete') }}
		</form>
		@endif
		<form class="frmMarkAsFound" method="post" action="javascript:void(0);">
			{{ csrf_field() }}
			{{ method_field('patch') }}
		</form>
		<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="/js/owl.carousel.min.js"></script>
		<script type="text/javascript" src="/tippyjs-master/dist/tippy.min.js"></script>
		<script type="text/javascript" src="/js/actions.js"></script>
	</body>
</html>