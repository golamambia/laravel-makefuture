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
        <h3>{{$user_text}}<span>- Address</span></h3>
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
            <h2>{{$user_text}} Address</h2>
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
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Address</label>
                      <div class="form-group">
                        <textarea class="form-control" name="address">{{$user->address}}</textarea>
                      </div>
                    </div>
                  </div>
                  @if($user->role_id=='2')
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Aadhaar Number</label>
                      <div class="form-group">
                        <input type="text" class="form-control" value="{{$user->aadhaar_number}}" placeholder="Singh" name="aadhaar_number">
                      </div>
                    </div>
                  </div>
                  @endif
                  <div class="col-lg-12 action full_row text-left">
                    <button type="submit"  class="btn btn-primary">Update</button>
                  </div>
                </div>
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