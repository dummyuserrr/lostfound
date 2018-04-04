<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel - missingZ</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/adminpanel/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script type="text/javascript" src="/adminpanel/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
        <script type="text/javascript" src="/adminpanel/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/adminpanel/css/cms.less">
        <script type="text/javascript" src="/js/less.min.js"></script>
    </head>
    <body>
        @if(session('role') == 'admin' || session('role') == 'superadmin')
        <nav class="navbar navbar-inverse" style="border-radius: 0;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">missingZ</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0);" class="btnlogout"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
                </ul>
            </div>
        </nav>
        <div class="container-full">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">ACTIONS</div>
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="/admin-panel/users/" class="list-group-item {{ adminSetActive3('admin-panel/users') }}">Users</a>
                            <a href="/admin-panel/registration-requests/" class="list-group-item {{ adminSetActive3('admin-panel/registration-requests') }}">Registration Requests {{ countRegistrationRequests() }}</a>
                            <a href="/admin-panel/message-queries/" class="list-group-item {{ adminSetActive3('admin-panel/message-queries') }}">Message Queries</a>
                            <a href="/admin-panel/system-logs/" class="list-group-item {{ adminSetActive3('admin-panel/system-logs') }}">System Logs</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                @if(session()->has('action'))
                    @if(session('action') == 'deleted')
                    <div class="alert alert-success alert-dismissable fade in text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Data has been deleted.
                    </div>
                    @elseif(session('action') == 'updated')
                    <div class="alert alert-success alert-dismissable fade in text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Data has been updated.
                    </div>
                    @elseif(session('action') == 'added')
                    <div class="alert alert-success alert-dismissable fade in text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Data has been added.
                    </div>
                    @endif
                @endif
                @yield('content')
            </div>
        </div>
        <form id="formLogout" method="post" action="/logout">
            {{ csrf_field() }}
        </form>
        @else
        <div class="container">
            <h3 class="text-center">You are not logged in.</h3>
        </div>
        @endif
        <script type="text/javascript" src="/adminpanel/js/cms.js"></script>
    </body>
</html>