<!DOCTYPE html>
<html lang="en">
<head>
    <title>T&L | Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
    <!-- Local -->
    <link rel="stylesheet" href="{{ asset('admin/css/local.css') }}">
    <!-- jQuery 3 -->
    <script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Validate local -->
    <script src="{{ asset('admin/js/utilities/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/utilities/jquery.validate.messages.js') }}"></script>
    <script src="{{ asset('admin/js/utilities/form.validate.js') }}"></script>
    <script src="{{ asset('admin/js/utilities/common.js') }}"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('dashboard') }}">T&L Admin</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#food">Food</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#location">Location</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a><span class="glyphicon glyphicon-user"></span> {{ $loggedUser->first_name . ' ' . $loggedUser->last_name }}</a></li>
            <li><a href="{{ route('auth.logout') }}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div id="menu">
        <h3><span class="glyphicon glyphicon glyphicon-th-list"></span> Menu</h3>
        <br><hr><br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Child</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menus as $key => $parent)
                    @php
                        $count = ($parent['child']) ? count($parent['child']) + 1 : 1;
                    @endphp
                    @if($parent['child'])
                        @foreach($parent['child'] as $child)
                            <tr>
                                <td rowspan="{{ $count }}">{{ $parent['id'] }}</td>
                                <td rowspan="{{ $count }}">{{ $parent['name'] }}</td>
                                <td>{{ $child['name'] }}</td>
                                <td>{{ $parent['created_at'] }}</td>
                                <td>A</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div id="food"></div>
    <div id="location"></div>
</div>

</body>
</html>
