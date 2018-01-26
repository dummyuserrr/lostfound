<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><link rel="stylesheet" type="text/less" href="/adminpanel/css/cms.less">
        <script type="text/javascript" src="/js/less.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse" style="border-radius: 0;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">missingZ</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="container-full">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">ACTIONS</div>
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">First item</a>
                            <a href="#" class="list-group-item">Second item</a>
                            <a href="#" class="list-group-item">Third item</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                @yield('content')
            </div>
        </div>
    </body>
</html>