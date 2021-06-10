@include('frontend.header')
@php
$user = currentUserDetails();
$user_text = ($user->role_id=='2')?'Franchise':'Student';
$banner_url = asset('/frontend/images/innerbanner2.jpg');
@endphp


<div class="subbanner_area" style="background-image:url({{$banner_url}});">
  <div class="container">
    <div class="darea">
      <div class="dimg"><img src="{{asset('/frontend/images/Student1.png')}}"   alt=""> </div>
      <div class="dtxt">
        <h3>{{$user_text}}<span>- Profile</span></h3>
        <ul>
          <li> {!!$user->first_name!!} {!!$user->last_name!!}</li>         
        </ul>
      </div>
    </div>
  </div>
</div>


<!-- my Account css Start -->
<div class="mainarea bg-white mt-2">
  <div class="myaccount_page">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
            @if($user->role_id=='2')
            @include('frontend.franchise-sidebar')
            @else
            @include('frontend.student-sidebar')
            @endif
        </div>
        <div class="col-lg-9 col-md-8 col-sm-6">
          <div class="myaccount_page_right">
            <h2>{{$user_text}} Profile</h2>
            @if($errors->any())   
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            @foreach ($errors->all() as $error)
            {{ $error }}<br>
            @endforeach
            </div>
            @endif
            <form method="POST" action="" class="customvalidation" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
              <div class="Profilepage">
                <h3>Personal Information</h3>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>First Name</label>
                      <div class="form-group">
                        <input type="text" class="form-control" value="{{$user->first_name}}" placeholder="Gurdeep" name="first_name" data-validation-engine="validate[required]">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Last Name</label>
                      <div class="form-group">
                        <input type="text" class="form-control" value="{{$user->last_name}}" placeholder="Singh" name="last_name" data-validation-engine="validate[required]">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Email Id</label>
                      <div class="form-group">
                        <input type="email" class="form-control" value="{{$user->email}}" placeholder="iamosahan@gmail.com" readonly="" data-validation-engine="validate[required,custom[email]]" name="email">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Mobile Number</label>
                      <div class="form-group">
                        <input type="text" class="form-control" value="{{$user->phone_number}}" placeholder="+44 3216549870" name="phone_number">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 action full_row text-left">
                    <button type="submit"  class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="myaccount_page_right">
            <h2 class="mt-0">Change Password</h2>
            <form method="POST" action="{{ url('change-password') }}" class="customvalidation" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="email" value="{{$user->email}}">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" id="password" name="password" placeholder="********" class="form-control" data-validation-engine="validate[required,minSize[8]]">
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" placeholder="********" class="form-control" data-validation-engine="validate[required,equals[password]]">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
          </div>

        </div>
      </div>      
    </div>
  </div>
</div>
<!-- my Account css End --> 


@section('more-scripts')

<script>

</script>

@stop

@include('frontend.footer')