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
$payment_through_array = unserialize(Payment_Through_Array);
@endphp


<div class="subbanner_area" style="background-image:url({{$banner_url}});">
  <div class="container">
    <div class="darea">
      <div class="dimg"><img src="{{asset('/frontend/images/Student1.png')}}"   alt=""> </div>
      <div class="dtxt">
        <h3>{{$user_text}}<span>- Apply Course View</span></h3>
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

                  <?php
                  $applyform_exam = DB::table('mf_applyform_exam')->where('applyform_id',$list->id)->orderBy('id', 'asc')->get();
                  ?>

                  <table class="table table-bordered table-hover">
                    <tbody>
                      <tr>
                        <th>Payment Status</th>
                        <td>
                          {!! $payment_status_array[$list->payment_status] !!}
                          @if ($list->payment_status!='1')
                          <a href="{{ url('/payment/'.$list->id) }}" title="Pay" class="btn btn-primary float-right">Pay</a>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th>Apply Date</th>
                        <td>{!! date_convert($list->created_at,3) !!}</td>
                      </tr>
                      <tr>
                        <th>Student</th>
                        <td>{!! $list->name !!}</td>
                      </tr>
                      <tr>
                        <th>DOB</th>
                        <td>{!! date_convert($list->dob,3) !!}</td>
                      </tr>
                      <tr>
                        <th>Father's Name</th>
                        <td>{!! $list->father_name !!}</td>
                      </tr>
                      <tr>
                        <th>Father's Mobile</th>
                        <td>{!! $list->father_mobile !!}</td>
                      </tr>
                      <tr>
                        <th>Mother's Name</th>
                        <td>{!! $list->mother_name !!}</td>
                      </tr>
                      <tr>
                        <th>Mother's Mobile</th>
                        <td>{!! $list->mother_mobile !!}</td>
                      </tr>
                      <tr>
                        <th>Nationality</th>
                        <td>{!! $list->nationality !!}</td>
                      </tr>
                      <tr>
                        <th>Caste</th>
                        <td>{!! $list->cast !!}</td>
                      </tr>
                      <tr>
                        <th>Sex</th>
                        <td>{!! $list->gender !!}</td>
                      </tr>
                      <tr>
                        <th>Nationality Citizenship / Aadhaar No.</th>
                        <td>{!! $list->citizenship !!}</td>
                      </tr>
                      <tr>
                        <th>Student's Mobile</th>
                        <td>{!! $list->student_mobile !!}</td>
                      </tr>
                      <tr>
                        <th>Email Address</th>
                        <td>{!! $list->email !!}</td>
                      </tr>
                      <tr>
                        <th>Parmanent Address</th>
                        <td>{!! $list->parmanent_address !!}</td>
                      </tr>
                      <tr>
                        <th>Local Guardian Address</th>
                        <td>{!! $list->local_address !!}</td>
                      </tr>

                      <tr>
                        <th colspan="2"><h3>Course Apply For:</h3></th>
                      </tr>

                      <tr>
                        <th>State</th>
                        <td>{!! $list->state_name !!}</td>
                      </tr>
                      <tr>
                        <th>College</th>
                        <td>{!! $list->college_name !!}</td>
                      </tr>
                      <tr>
                        <th>Academic Year</th>
                        <td>{!! $list->academic_year !!}</td>
                      </tr>
                      <tr>
                        <th>Course</th>
                        <td>{!! $list->course_name !!}</td>
                      </tr>
                      <tr>
                        <th>Amount</th>
                        <td>{!! $currency_with_icon_array[$list->currency] !!}{!! $list->price !!}</td>
                      </tr>

                      <tr>
                        <th colspan="2"><h3>Academic Details: </h3></th>
                      </tr>
                      <tr>
                        <td colspan="2">
                          
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                      <th>Subject Name / Course Details</th>
                      <th>Marks Obtain</th>
                      <th>Percentage</th>
                      <th>Documents</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($applyform_exam as $key => $value)
                      <tr>
                      <td>{!! $value->subject_name !!}</td>
                      <td>{!! $value->marks !!}</td>
                      <td>{!! $value->percentage !!}</td>
                      <td>
                         @if( $value->document && File::exists(public_path('uploads/'.$value->document)) )
                         <a href="{{asset('/uploads/'.$value->document)}}" download><i class="fa fa-upload" aria-hidden="true"></i> Download File</a>
                         @endif
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                        </td>
                      </tr>

                      @if ($transaction)

                      <tr>
                        <th colspan="2"><h3>Transaction Details: </h3></th>
                      </tr>
                      <tr>
                        <th>Payment by</th>
                        <td>{!! $payment_through_array[$transaction->payment_through] !!}</td>
                      </tr>
                      <tr>
                        <th>Transaction ID#</th>
                        <td>{{$transaction->transaction_id}}</td>
                      </tr>
                      <tr>
                        <th>Payment Amount</th>
                        <td>{!! $currency_with_icon_array[$transaction->currency] !!} {{$transaction->amount}}</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>


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