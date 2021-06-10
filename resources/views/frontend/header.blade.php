<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if(@$setting[0]->value){ echo @$setting[0]->value.' | '.config('site.title') ; }else{ echo config('site.title'); } ?></title>
  <meta name="keywords" content="<?php if(@$setting[1]->value){ echo @$setting[1]->value ; }else{ echo config('site.meta_keyword'); } ?>">
  <meta name="description" content="<?php if(@$setting[2]->value){ echo @$setting[2]->value ; }else{ echo config('site.meta_description'); } ?>">
    @if(config('site.logo2') && File::exists(public_path('uploads/'.config('site.logo2'))))
    <link rel="shortcut icon" href="{!! ( config('site.logo2') && File::exists(public_path('uploads/'.config('site.logo2'))) ) ? asset('/uploads/'.config('site.logo2')) : '' !!}" type="image/x-icon" />
    @endif
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" type="text/css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset("/frontend/css/validationEngine.jquery.min.css") }}">
<!-- Bootstrap -->
<link href="{{ asset("/frontend/css/bootstrap.min.css") }}" rel="stylesheet">
<link href="{{ asset("/frontend/css/style.css") }}" rel="stylesheet">
<link href="{{ asset("/frontend/css/responsive.css") }}" rel="stylesheet">
</head>

<body>
@php
$header_menu = get_fields_value_where('pages',"(display_in='1' or display_in='3') and parent_id='0'",'menu_order','asc');
@endphp
<!-- header css Start -->
<header class="header_area clearfix">
  <div class="header_areatop clearfix">
    <div class="container">
      <div class="effet"></div>
      <div class="header_areatop_right">
        <ul>
          <li><a href="tel:{!!preg_replace('/\D+/', '', config('site.phone'))!!}"><i class="fas fa-phone-alt" ></i>Call Us : {!!config('site.phone')!!}</a></li>
          <li><a href="mailto:{!!config('site.email')!!}"><i class="far fa-envelope" ></i>Email Us : {!!config('site.email')!!} </a></li>
          @if (Auth::check())
            @php
            $user = currentUserDetails();
            @endphp
          <li class="list-inline-item"> <a class="dropdown-toggle "  href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> <i class="far fa-user"></i></span> My Account </a>
            <ul class="dropdown-menu  animated flipInX">
              @if ($user->role_id=='2')
              <a class="dd-item {{ (Request::is('profile') ? 'active' : '') }}" href="{{ url('/profile') }}"><i class="zmdi zmdi-account"></i>Franchise Profile</a> 
              <a class="dd-item {{ (Request::is('address') ?'active':'') }}" href="{{ url('/address') }}"><i class="zmdi zmdi-pin"></i> Address</a> 
              <a class="dd-item {{ (Request::is('student-list') ?'active':'') }}" href="{{ url('/student-list') }}"><i class="zmdi zmdi-comments"></i> Student List</a> 
              @else
              <a class="dd-item {{ (Request::is('profile') ?'active':'') }}" href="{{ url('/profile') }}"><i class="zmdi zmdi-account"></i>Student Profile</a> 
              <a class="dd-item {{ (Request::is('address') ?'active':'') }}" href="{{ url('/address') }}"><i class="zmdi zmdi-pin"></i> Address</a> 
              @endif
              <a class="dd-item last" href="{{ url('/logout') }}"> <i class="zmdi zmdi-power"></i> Logout</a>
            </ul>
          </li>
          @else
          <li><a href="{{url('login')}}" class="btn btn-light">Signin / SignUp </a></li>
          <li><a href="{{url('login')}}" class="btn btn-outline-light">Franchise Login</a></li>
          @endif
        </ul>
      </div>
    </div>
  </div>
  <div class="bg-light start-header start-style clearfix">
    <div class="container clearfix">
      <div class="logomain"> <a href="{{ url('/') }}"><img src="{!! ( config('site.logo') && File::exists(public_path('uploads/'.config('site.logo'))) ) ? asset('/uploads/'.config('site.logo')) : asset('/frontend/images/logomain.png') !!}" alt=""></a> </div>
      <div class="menu">
        <div class="menuButton"> <span></span> <span></span> <span></span> </div>
        <ul>
                    @foreach($header_menu as $menu)
                        <li class="{{ (Request::is(($menu->id=='1'?'/':$menu->slug)) ? 'active' : '') }}"><a href="{!! url('/'.($menu->id=='1'?'':$menu->slug)) !!}">{!!$menu->page_title?$menu->page_title:$menu->page_name!!}</a>
                        @php
                        $header_sub_menu = get_fields_value_where('pages',"(display_in='1' or display_in='3') and parent_id='".$menu->id."'",'menu_order','asc');
                        @endphp
                        @if(count($header_sub_menu)>0)
                        <ul class="menu-dropdown">
                            @foreach($header_sub_menu as $sub_menu)
                            <li class="{{ (Request::is(($sub_menu->id=='1'?'/':$sub_menu->slug)) ? 'active' : '') }}"><a href="{!! url('/'.($sub_menu->id=='1'?'':$sub_menu->slug)) !!}">{!!$sub_menu->page_title?$sub_menu->page_title:$sub_menu->page_name!!}</a></li>
                            @endforeach
                        </ul>
                        @endif
                        </li>
                    @endforeach
        </ul>
        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-subscribe">Enquiry</a> </div>
    </div>
  </div>
</header>
