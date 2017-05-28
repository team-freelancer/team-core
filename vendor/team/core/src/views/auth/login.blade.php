<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('vendor/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/admin/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/admin/css/blue.css')}}" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>Admin</b>Controll</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        {!! $errors->first('login') ? '<div class="alert alert-danger">'.$errors->first('login').'</div>' : '' !!}
        <form action="" method="post">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Email" name="email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        {{-- <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> --}}

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="{{ asset('vendor/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/admin/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('vendor/admin/js/icheck.min.js') }}" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>