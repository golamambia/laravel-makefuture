@include('frontend.header')
@php
$user = currentUserDetails();
$user_text = ($user->role_id=='2')?'Franchise':'Student';
$banner_url = asset('/frontend/images/innerbanner2.jpg');
@endphp
@php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$order_status_array = unserialize(Order_Status_Array);
$payment_status_array = unserialize(Payment_Status_Array);
$refund_status_array = unserialize(Refund_Status_Array);
@endphp


<div class="subbanner_area" style="background-image:url({{$banner_url}});">
  <div class="container">
    <div class="darea">
      <div class="dimg"><img src="{{asset('/frontend/images/Student1.png')}}"   alt=""> </div>
      <div class="dtxt">
        <h3>{{$user_text}}<span>- Apply Course</span></h3>
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
                      <!-- <th>Student Name</th> -->
                      <!-- <th>State</th> -->
                      <th>College</th>
                      <th>Course</th>
                      <th>Academic Year</th>
                      <th>Price</th>
                      <th>Payment Status</th>
                      <th>Date</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($lists as $key => $value)
                      <tr>
                      <!-- <td>{!! $value->name !!}</td> -->
                      <!-- <td>{!! $value->state_name !!}</td> -->
                      <td>{!! $value->college_name !!}</td>
                      <td>{!! $value->course_name !!}</td>
                      <td>{!! $value->academic_year !!}</td>
                      <td>{!! $currency_with_icon_array[$value->currency] !!}{!! $value->price !!}</td>
                      <td>{!! $payment_status_array[$value->payment_status] !!}</td>
                      <td>{!! date_convert($value->created_at,3) !!}</td>
                      <td>
                        <a href="{{ url('/apply-course/view/'.$value->id) }}" title="View"><i class="fa fa-fw fa-eye"></i></a>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>


          </div>
          <!-- {{$lists->appends(request()->input())->links()}} -->
          {{$lists->links("pagination::bootstrap-4")}}

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