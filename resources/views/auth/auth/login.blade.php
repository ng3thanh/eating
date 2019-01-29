<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>T&L | Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
    </head>
    <body>
        <div class="">
            <div class="">
                <a href="#">
                    <b>T&L</b> Login
                </a>
            </div>

            <div class="col-lg-4">
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('auth.login.attempt') }}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback {{ ($errors->has('username')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Username" name="username" type="text" value="{{ old('username') }}">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        {!! ($errors->has('username') ? $errors->first('username', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group has-feedback {{ ($errors->has('password')) ? 'has-error' : '' }}">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        {!! ($errors->has('password') ? $errors->first('password', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="">
                                <label>
                                    <input name="remember" type="checkbox" value="true" {{ old('remember') == 'true' ? 'checked' : ''}}> &nbsp;&nbsp;Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    </body>
</html>