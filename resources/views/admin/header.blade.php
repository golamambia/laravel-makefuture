@if(Auth::check())
<?php $user = Auth::user(); ?>

<!--login-->
@if($user->role_id!='1')
<script type="text/javascript">
  window.location = "{{ url('/') }}";
</script>
<?php die();?>
@endif

@else

<!--not login-->
<script type="text/javascript">
  window.location = "{{ url('/admin') }}";
</script>
<?php die();?>
@endif



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('site.title')}} | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/font-awesome/css/font-awesome.min.css") }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/Ionicons/css/ionicons.min.css") }}">

  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/morris.js/morris.css") }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/jvectormap/jquery-jvectormap.css") }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css") }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/bootstrap-daterangepicker/daterangepicker.css") }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css") }}">

  <link href="{{ asset("/admin_lte/dist/css/validationEngine.jquery.min.css") }}" rel="stylesheet">

  <!-- Select2 -->

  <link href="{{ asset("/admin_lte/bower_components/select2/dist/css/select2.min.css") }}" rel="stylesheet" type="text/css" />


  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("/admin_lte/dist/css/AdminLTE.min.css") }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="{{ asset("/admin_lte/dist/css/skins/_all-skins.min.css") }}">

  <link rel="stylesheet" href="{{ asset("/admin_lte/dist/css/custom.css") }}">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="{{ url('/admin') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
          @if(config('site.logo2') && File::exists(public_path('uploads/'.config('site.logo2'))))
          <img src="{!! url('/uploads/'.config('site.logo2')) !!}" alt="" width="30"> 
          @else
          <b>M</b>F
          @endif
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ explode(' ', config('site.title') )[0]}}</b> {{ ltrim( config('site.title'), explode(' ', config('site.title') )[0]  ) }}</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
            <li><a href="{{ url('/') }}" target="_blank">Visit Site</a> </li>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if ($user->avatar!='')
                  <img src="{{ url('/uploads/'.$user->avatar) }}" class="user-image" alt="User Image">
                @else
                  <img src="{{ asset("/admin_lte/dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image">
                @endif
                <span class="hidden-xs">{{$user->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  @if ($user->avatar!='')
                    <img src="{{ url('/uploads/'.$user->avatar) }}" class="img-circle" alt="User Image">
                  @else
                    <img src="{{ asset("/admin_lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
                  @endif

                  <p>
                    {{$user->name}} - {!! get_field_value('roles','display_name','id',$user->role_id) !!}
                    <!-- <small>Member since Nov. 2012</small> -->
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('/admin/user/edit/'.$user->id) }}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            
          </ul>
        </div>
      </nav>
    </header>
