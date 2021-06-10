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

              <form method="POST" action="{{ url('admin/order/status') }}" class="customvalidation" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{$order->id}}">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Order Status</label>
                      <select name="status" class="form-control order_status">
                        @foreach($order_status_array as $s => $st)
                        <option value="{{$s}}" {!! $order->status==$s?'selected':'' !!}>{{$st}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group proofreader">
                    <label class="control-label">Proofreader Assigned</label> 
                  <select name="proofreader_id" class="form-control">
                    <option value="">Select</option>
                    @foreach($proofreaders as $pr => $pro)
                    <option value="{{$pro->id}}" {!! $order->proofreader_id==$pro->id?'selected':'' !!}>{{$pro->first_name}} {{$pro->last_name}} - {{$pro->email}}</option>
                    @endforeach
                  </select>
                  </div>
                </div>
                <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </div>
              </div>
              </form>

              <div class="row">
                <div class="col-sm-12">

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Order Status</label>
                    <div class="col-sm-8">{!! $order_status_array[$order->status] !!} </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Order ID</label>
                    <div class="col-sm-6">{!! get_orderID($order->id) !!} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Customer</label>
                    <div class="col-sm-6">{!! get_field_value('users','first_name','id',$order->user_id) !!} {!! get_field_value('users','last_name','id',$order->user_id) !!} - {!! get_field_value('users','email','id',$order->user_id) !!}</div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Billing First Name</label>
                    <div class="col-sm-6">{{$order->billing_first_name}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Billing Last Name</label>
                    <div class="col-sm-6">{{$order->billing_last_name}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Billing Email</label>
                    <div class="col-sm-6">{{$order->billing_email}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">No. of Word</label>
                    <div class="col-sm-6">{{$order->no_of_word}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Amount</label>
                    <div class="col-sm-6">{!! $currency_with_icon_array[$order->currency].' '.$order->total_amount !!} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Notes by customer</label>
                    <div class="col-sm-9">{{$order->notes}} </div>
                  </div>

                  @if ($order->proofreader_notes)
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Notes by proofreader</label>
                    <div class="col-sm-9">{{$order->proofreader_notes}} </div>
                  </div>
                  @endif

                  @if( $order->upload_file && File::exists(public_path('uploads/order/'.$order->upload_file)) )
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Customer uploaded file</label>
                    <div class="col-sm-6"><a href="{{asset('/uploads/order/'.$order->upload_file)}}" download><i class="fa fa-upload" aria-hidden="true"></i> Download Customer File</a> </div>
                  </div>
                  @endif

                  @if( $order->download_file && File::exists(public_path('uploads/order/'.$order->download_file)) )
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Proofreader uploaded file</label>
                    <div class="col-sm-6"><a href="{{asset('/uploads/order/'.$order->download_file)}}" download><i class="fa fa-upload" aria-hidden="true"></i> Download Customer File</a> </div>
                  </div>
                  @endif

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">ETA</label>
                    <div class="col-sm-6">{{$order->eta}} </div>
                  </div>

                  @if ($order->status=='4')
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Order duration</label>
                    <div class="col-sm-6">
                      <?php
                      $hr = datediff('h',$order->order_accept,$order->order_complete);
                      $m = datediff('n',$order->order_accept,$order->order_complete);
                      echo $hr.($hr>1? "hr, ":"hrs, ");
                      echo $m.($m>1? " minute":" minutes");
                      ?>
                    </div>
                  </div>
                  @endif

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
                  <div class="col-sm-8">{!! $payment_status_array[$order->payment_status] !!} </div>
                </div>
                <hr />
              @endif
                  
                </div>               
              </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('/admin/order') }}'" >Back</button>
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
