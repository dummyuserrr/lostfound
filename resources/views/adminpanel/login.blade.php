<!DOCTYPE html>
<html lang="en">
	<head>
		<title>missingZ Admin Panel</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse" style="border-radius: 0">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">missingZ</a>
				</div>
			</div>
		</nav>
		<div class="container-full">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading text-center">Authentication</div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<label class="control-label col-sm-2" for="username">Username:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" placeholder="Enter username" autofocus>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Password:</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="pwd" placeholder="Enter password">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-danger">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</body>
</html>