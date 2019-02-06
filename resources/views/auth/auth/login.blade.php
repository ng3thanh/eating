<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>T&H | Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin.assets.css')
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#">
                    <b>T&H</b> Login
                </a>
            </div>

            <div class="login-box-body">
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

        @include('admin.assets.js')
    </body>
</html>