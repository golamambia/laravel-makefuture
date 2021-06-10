
          <div class="myaccount_page_left">
            
            <ul class="nav flex-column border-0 pt-4 pl-4 pb-4">
              <li class="nav-item {{ (Request::is('profile') ? 'active' : '') }}"><a class="" href="{{ url('/profile') }}"><i class="zmdi zmdi-account"></i>Student Profile</a> </li>
              <li class="nav-item {{ (Request::is('address') ? 'active' : '') }}"><a class="" href="{{ url('/address') }}"><i class="zmdi zmdi-pin"></i> Address</a> </li>
               <li class="nav-item {{ (Request::is('apply-course') ? 'active' : '') }}"><a class="" href="{{ url('apply-course') }}"><i class="zmdi zmdi-comments"></i> Apply Course</a> </li>
              <li class="nav-item"><a class="" href="{{ url('/logout') }}"> <i class="zmdi zmdi-power"></i> Logout</a></li>
            </ul>
          </div>