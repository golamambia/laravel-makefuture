<!-- Left side column. contains the logo and sidebar -->
<?php $user = Auth::user(); ?>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        @if ($user->avatar!='')
          <img src="{{ url('/uploads/'.$user->avatar) }}" class="img-circle" alt="User Image">
        @else
          <img src="{{ asset("/admin_lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        @endif
      </div>
      <div class="pull-left info">
        <p>{{$user->name}}</p>
        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <li class="{{ (Request::is('admin') ? 'active' : '') }}">
        <a href="{{ url('/admin') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="treeview {{ (Request::is('admin/apply-form') || Request::is('admin/apply-form/view/*') || Request::is('admin/transaction') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>Apply Form</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/apply-form') || Request::is('admin/apply-form/view/*') ? 'active' : '') }}"><a href="{{ url('/admin/apply-form') }}"><i class="fa fa-circle-o"></i> Apply Form</a>
          </li>
          <li class="{{ (Request::is('admin/transaction') ? 'active' : '') }}"><a href="{{ url('/admin/transaction') }}"><i class="fa fa-circle-o"></i> Transaction</a>
          </li>
        </ul>
      </li>

      <!-- <li class="treeview {{ (Request::is('admin/proofreader/view-payment-request-release') || Request::is('admin/proofreader/view-earning') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>Proofreader</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(check_page_permission('earning'))
          <li class="{{ (Request::is('admin/proofreader/view-earning') ? 'active' : '') }}"><a href="{{ url('/admin/proofreader/view-earning') }}"><i class="fa fa-circle-o"></i> Earning</a>
          </li>
          @endif
        </ul>
      </li> -->

      <li class="treeview {{ (Request::is('admin/page') || Request::is('admin/page/add') || Request::is('admin/page/edit/*') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>Pages</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/page') ? 'active' : '') }}"><a href="{{ url('/admin/page') }}"><i class="fa fa-circle-o"></i> Pages</a></li>
          <li class="{{ (Request::is('admin/page/add') || Request::is('admin/page/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/page/add') }}"><i class="fa fa-circle-o"></i> Add Page</a></li>
        </ul>
      </li>
      
      <li class="treeview {{ (Request::is('admin/user') || Request::is('admin/user/franchise') || Request::is('admin/user/student') || Request::is('admin/user/add') || Request::is('admin/user/edit/*') || Request::is('admin/user/cancel-request') || Request::is('admin/user/view-cancel-request/*') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-user"></i> <span>Users</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/user') ? 'active' : '') }}"><a href="{{ url('/admin/user') }}"><i class="fa fa-circle-o"></i> Admin</a></li>
          <li class="{{ (Request::is('admin/user/franchise') ? 'active' : '') }}"><a href="{{ url('/admin/user/franchise') }}"><i class="fa fa-circle-o"></i> Franchise</a></li>
          <li class="{{ (Request::is('admin/user/student') ? 'active' : '') }}"><a href="{{ url('/admin/user/student') }}"><i class="fa fa-circle-o"></i> Student</a></li>
          <li class="{{ (Request::is('admin/user/add') || Request::is('admin/user/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/user/add') }}"><i class="fa fa-circle-o"></i> Add User</a></li>
        </ul>
      </li> 

      <li class="treeview {{ (Request::is('admin/college') || Request::is('admin/college/add') || Request::is('admin/college/edit/*') || Request::is('admin/college/faculty') || Request::is('admin/college/faculty/add') || Request::is('admin/college/faculty/edit/*') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>Colleges</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/college') ? 'active' : '') }}"><a href="{{ url('/admin/college') }}"><i class="fa fa-circle-o"></i> Colleges</a></li>
          <li class="{{ (Request::is('admin/college/add') || Request::is('admin/college/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/college/add') }}"><i class="fa fa-circle-o"></i> Add College</a></li>
          <li class="{{ (Request::is('admin/college/faculty') || Request::is('admin/college/faculty/add') || Request::is('admin/college/faculty/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/college/faculty') }}"><i class="fa fa-circle-o"></i> Faculties</a></li>
        </ul>
      </li>

      <li class="treeview {{ (Request::is('admin/course') || Request::is('admin/course/add') || Request::is('admin/course/edit/*') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>Courses</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/course') ? 'active' : '') }}"><a href="{{ url('/admin/course') }}"><i class="fa fa-circle-o"></i> Courses</a></li>
          <li class="{{ (Request::is('admin/course/add') || Request::is('admin/course/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/course/add') }}"><i class="fa fa-circle-o"></i> Add Course</a></li>
        </ul>
      </li>

      <li class="treeview {{ (Request::is('admin/state') || Request::is('admin/state/add') || Request::is('admin/state/edit/*') || Request::is('admin/city') || Request::is('admin/city/add') || Request::is('admin/city/edit/*') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>States / Cities</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/state') || Request::is('admin/state/add') || Request::is('admin/state/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/state') }}"><i class="fa fa-circle-o"></i> States</a></li>
          <li class="{{ (Request::is('admin/city') || Request::is('admin/city/add') || Request::is('admin/city/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/city') }}"><i class="fa fa-circle-o"></i> Cities</a></li>
        </ul>
      </li>

      <li class="treeview {{ (Request::is('admin/news') || Request::is('admin/news/add') || Request::is('admin/news/edit/*') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>News</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/news') ? 'active' : '') }}"><a href="{{ url('/admin/news') }}"><i class="fa fa-circle-o"></i> News</a></li>
          <li class="{{ (Request::is('admin/news/add') || Request::is('admin/news/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/news/add') }}"><i class="fa fa-circle-o"></i> Add News</a></li>
        </ul>
      </li>

      <li class="treeview {{ (Request::is('admin/partner') || Request::is('admin/partner/add') || Request::is('admin/partner/edit/*') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>Partners</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/partner') ? 'active' : '') }}"><a href="{{ url('/admin/partner') }}"><i class="fa fa-circle-o"></i> Partners</a></li>
          <li class="{{ (Request::is('admin/partner/add') || Request::is('admin/partner/edit/*') ? 'active' : '') }}"><a href="{{ url('/admin/partner/add') }}"><i class="fa fa-circle-o"></i> Add Partner</a></li>
        </ul>
      </li>

      <li class="treeview {{ (Request::is('admin/settings') || Request::is('admin/emailtemplate') || Request::is('admin/user-permission') ? 'active' : '') }}">
        <a href="#">
          <i class="fa fa-cog"></i> <span>Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (Request::is('admin/settings') ? 'active' : '') }}"><a href="{{ url('/admin/settings') }}"><i class="fa fa-circle-o"></i> Settings</a></li>
          <!-- <li class="{{ (Request::is('admin/user-permission') ? 'active' : '') }}"><a href="{{ url('/admin/user-permission') }}"><i class="fa fa-circle-o"></i> User Permission</a></li> -->
          <li class="{{ (Request::is('admin/emailtemplate') ? 'active' : '') }}"><a href="{{ url('/admin/emailtemplate') }}"><i class="fa fa-circle-o"></i> Email Template</a></li>
        </ul>
      </li> 

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>