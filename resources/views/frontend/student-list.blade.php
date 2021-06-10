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
        <h3>{{$user_text}}<span>- Student List</span></h3>
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


                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                      <th>Subject Name</th>
                      <th>Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($referrals as $key => $value)
                      <tr>
                      <td>{!! $value->first_name !!} {!! $value->last_name !!}</td>
                      <td>{!! $value->email !!}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>


          </div>
          {{$referrals->links("pagination::bootstrap-4")}}

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