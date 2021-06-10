@include('admin.header')

@include('admin.sidebar')
@php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$order_status_array = unserialize(Order_Status_Array);
$payment_status_array = unserialize(Payment_Status_Array);
$refund_status_array = unserialize(Refund_Status_Array);
$payment_through_array = unserialize(Payment_Through_Array);
@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Order
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">View Order</li>
    </ol>
  </section>

  
  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-xm-12 col-sm-12 col-md-12">

        <div class="box box-primary">
          <div class="box-header with-border">
            <!--<h3 class="box-title">Quick Example</h3>-->
          </div>
          <!-- /.box-header -->

            <div class="box-body">

              @if($errors->any())   
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                @foreach ($errors->all() as $error)
                {{ $error }}<br>
                @endforeach
              </div>
              @endif

              @if (session()->has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Success</h4>
                Order Status has been updated successfully.
              </div>
              @endif

              <div class="row">
                <div class="col-sm-12">

                  <?php
                  $franchise = DB::table('mf_referral')->where('user_id',$applyform->user_id)->first();
                  ?>
                  @if($franchise)
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Franchise</label>
                    <div class="col-sm-6"><strong>{!! get_field_value('users','first_name','id',$franchise->referred_by) !!} {!! get_field_value('users','last_name','id',$franchise->referred_by) !!} - {!! get_field_value('users','email','id',$franchise->referred_by) !!}</strong></div>
                  </div>
                  @endif

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Payment Status</label>
                    <div class="col-sm-8">{!! $payment_status_array[$applyform->payment_status] !!} </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Order ID</label>
                    <div class="col-sm-6">{!! $applyform->id !!} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">User</label>
                    <div class="col-sm-6">{!! get_field_value('users','first_name','id',$applyform->user_id) !!} {!! get_field_value('users','last_name','id',$applyform->user_id) !!} - {!! get_field_value('users','email','id',$applyform->user_id) !!}</div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Student Full Name</label>
                    <div class="col-sm-6">{{$applyform->name}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">DOB</label>
                    <div class="col-sm-6">{!! date_convert($applyform->dob,3) !!} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Father's Name</label>
                    <div class="col-sm-6">{{$applyform->father_name}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Father's Mobile</label>
                    <div class="col-sm-6">{{$applyform->father_mobile}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Mother's Name</label>
                    <div class="col-sm-6">{{$applyform->mother_name}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Mother's Mobile</label>
                    <div class="col-sm-6">{{$applyform->mother_mobile}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Nationality</label>
                    <div class="col-sm-6">{{$applyform->nationality}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Caste</label>
                    <div class="col-sm-6">{{$applyform->cast}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Sex</label>
                    <div class="col-sm-6">{{$applyform->gender}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Nationality Citizenship / Aadhaar No.</label>
                    <div class="col-sm-6">{{$applyform->citizenship}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Student's Mobile</label>
                    <div class="col-sm-6">{{$applyform->student_mobile}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Email Address</label>
                    <div class="col-sm-6">{{$applyform->email}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Parmanent Address</label>
                    <div class="col-sm-6">{{$applyform->parmanent_address}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Local Guardian Address</label>
                    <div class="col-sm-6">{{$applyform->local_address}} </div>
                  </div>

                  <div class="col-lg-12">
                    <h3>Course Apply For:</h3>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">State</label>
                    <div class="col-sm-6">{!! get_field_value('mf_state', 'name', 'id', $applyform->state_id)!!} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">College</label>
                    <div class="col-sm-6">{!! get_field_value('mf_college', 'college_name', 'id', $applyform->college_id)!!} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Academic Year</label>
                    <div class="col-sm-6">{{$applyform->academic_year}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Course</label>
                    <div class="col-sm-6">{!! get_field_value('mf_course', 'name', 'id', $applyform->course_id)!!} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Amount</label>
                    <div class="col-sm-6">{!! $currency_with_icon_array[$applyform->currency].' '.$applyform->price !!} </div>
                  </div>

                  <div class="col-lg-12">
                    <h3>Academic Details: </h3>
                  </div>
                  <?php
                  $applyform_exam = DB::table('mf_applyform_exam')->where('applyform_id',$applyform->id)->orderBy('id', 'asc')->get();
                  ?>
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

              @if ($transaction)
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Payment by</label>
                  <div class="col-sm-8">{!! $payment_through_array[$transaction->payment_through] !!} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Transaction ID#</label>
                  <div class="col-sm-8">{{$transaction->transaction_id}} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Payment Amount</label>
                  <div class="col-sm-8">{!! $currency_with_icon_array[$transaction->currency] !!} {{$transaction->amount}} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Payment Status</label>
                  <div class="col-sm-8">{!! $payment_status_array[$applyform->payment_status] !!} </div>
                </div>
                <hr />
              @endif
                  
                </div>               
              </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('/admin/apply-form') }}'" >Back</button>
              </div>

            </form>
          </div>
          <!-- /.box -->

        </div>


      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->


@section('more-scripts')

<script type="text/javascript">
$(document).ready(function(){
  $('.order_status').change(function(){
    change_order_status();
  });
  change_order_status();
});
function change_order_status() {
  var status = $('.order_status').val();
  if (status=='2' || status=='4') {
    $('.proofreader').show('slow');
  }else{
    $('.proofreader').hide('slow');
  }
}
</script>

@stop

  @include('admin.footer')
