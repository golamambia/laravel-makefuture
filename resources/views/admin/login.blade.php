<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/font-awesome/css/font-awesome.min.css") }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/Ionicons/css/ionicons.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/dist/css/AdminLTE.min.css") }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/plugins/iCheck/square/blue.css") }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      @if( config('site.logo')!='' && File::exists(public_path('uploads/'.config('site.logo'))) )
      <a href="{{url('/')}}"><img src="{{ url('/uploads/'.config('site.logo')) }}" class="user-image" alt="User Image" style="height: 150px;"></a>
      @else
        <a href="{{url('/')}}"><b>Admin</b>LTE</a>
      @endif
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <!--<p class="login-box-msg">Sign in to start your session</p>-->

      {{ Form::open(array('url' => 'admin/login')) }}

      @csrf

      <!-- if there are login errors, show them here -->
      @if($errors->has('email') || $errors->has('password') || $errors->has('authentication') || $errors->has('errormsg'))   
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {{ $errors->first('email') }}
        {{ $errors->first('password') }}
        {{ $errors->first('authentication') }}
        {{ $errors->first('errormsg') }}
      </div>
      @endif


      <div class="form-group has-feedback">
        {{ Form::text('email', Request::old('email'), array('placeholder' => 'Email', 'class' => 'form-control')) }}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          {{ Form::submit('Sign In', array('class' => 'btn btn-primary btn-block btn-flat')) }}
        </div>
        <!-- /.col -->
      </div>
      {{ Form::close() }}

      @if (Route::has('password.request'))
      <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
      </a>
      @endif

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="{{ asset("/admin_lte/bower_components/jquery/dist/jquery.min.js") }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset("/admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
  <!-- iCheck -->
  <script src="{{ asset("/admin_lte/plugins/iCheck/icheck.min.js") }}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>
</html>
