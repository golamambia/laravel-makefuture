
          <div class="myaccount_page_left">
            
            <ul class="nav flex-column border-0 pt-4 pl-4 pb-4">
              <li class="nav-item {{ (Request::is('profile') ? 'active' : '') }}"><a class="" href="{{ url('/profile') }}"><i class="zmdi zmdi-account"></i>Franchise Profile</a> </li>
              <li class="nav-item {{ (Request::is('address') ? 'active' : '') }}"><a class="" href="{{ url('/address') }}"><i class="zmdi zmdi-pin"></i> Address</a> </li>
              <li class="nav-item {{ (Request::is('student-list') ? 'active' : '') }}"><a class="" href="{{ url('/student-list') }}"><i class="zmdi zmdi-comments"></i> Student List</a> </li>
              <li class="nav-item {{ (Request::is('wallet') ? 'active' : '') }}"><a class="" href="{{ url('/wallet') }}"><i class="zmdi zmdi-comments"></i> wallet</a> </li>
              <li class="nav-item {{ (Request::is('redeem-point') ? 'active' : '') }}"><a class="" href="{{ url('redeem-point') }}"><i class="zmdi zmdi-comments"></i> redeem points</a> </li>
               <li class="nav-item {{ (Request::is('payment') ? 'active' : '') }}"><a class="" href="{{ url('payment') }}"><i class="zmdi zmdi-comments"></i> Payment</a> </li>
              <li class="nav-item"><a class="" href="{{ url('/logout') }}"> <i class="zmdi zmdi-power"></i> Logout</a></li>
            </ul>
          </div>
          