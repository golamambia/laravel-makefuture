@include('admin.header')

@include('admin.sidebar')
@php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$order_status_array = unserialize(Order_Status_Array);
$payment_status_array = unserialize(Payment_Status_Array);
$refund_status_array = unserialize(Refund_Status_Array);
@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Orders <!--<button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('/admin/user/export') }}'" title="Export Active User">Export</button>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    @if($errors->any())   
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      @foreach ($errors->all() as $error)
      {{ $error }}<br>
      @endforeach
    </div>
    @endif

   @if (session()->has('delete_success'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    Order has been deleted successfully.
  </div>
  @endif
   @if (session()->has('status_success'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    Order Status is updated successfully.
  </div>
  @endif
   @if (session()->has('message'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    {{ Session::get('message') }}
  </div>
  @endif 
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
       <div class="box-header">
        <h3 class="box-title">&nbsp;</h3>
        <div class="box-tools1">
          <form action="">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group1">
                  <label>Date From:</label> 

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="sdate" class="form-control pull-right from_date" value="{!! date_convert($from_date,5) !!}" autocomplete="off">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group1">
                  <label>Date To:</label> 

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="edate" class="form-control pull-right to_date" value="{!! date_convert($to_date,5) !!}" autocomplete="off">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group1">
                  <label class="control-label">Payment Status</label>
                  <select name="status" class="form-control order_status">
                    <option value="">All</option>
                    @foreach($payment_status_array as $s => $st)
                    <option value="{{$s}}" {!! $status==$s && $status!=''?'selected':'' !!}>{{$st}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group1">
                  <label>&nbsp; </label> <br>
                <button type="submit" class="btn btn-primary">Go</button>
                </div>
              </div>

              <div class="col-md-2">
                  <label>&nbsp; </label> <br>
                <div class="input-group input-group-sm" style="width: 150px;float: right;">

                  <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{ $search }}">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>

                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">

        <table id="example1" class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
              @foreach($column_array as $key => $value)
              <th>
                <a href="{{ $sorting_array[$key]['sorting_url'] }}" class="{{ $sorting_array[$key]['sorting_class'] }}">{{$value}}</a>
              </th>
              @endforeach
              <th>
                Action
              </th>
            </tr>
          </thead>
          <tbody>

          @if ($orders->count() > 0)
          <?php 
          /*$total_order_amount = 0;
          $proofreader_amount = 0;
          $total_cancel_amount = 0;*/
           ?>
           @foreach($orders as $order)
          <?php 
          /*$total_order_amount = $total_order_amount + $order->total_amount;
          if ($order->status=='4') {
            $proofreader_amount = $proofreader_amount + get_field_value('av_earning_tbl','amount','order_id',$order->id);
          }
          if ($order->status=='3') {
            $total_cancel_amount = $total_cancel_amount + $order->total_amount;
          }*/
          $currency = $order->currency;
           ?>

           <tr>
            @foreach($column_array as $key => $value)
              
              @if ($key=='price')
                <td>{!! $currency_with_icon_array[$order->currency].' '.$order->$key !!}</td>
              @elseif ($key=='user_id')
                <td>{!! get_field_value('users','first_name','id',$order->$key) !!} {!! get_field_value('users','last_name','id',$order->$key) !!}</td>
              @elseif ($key=='created_at')              
                <td>{!! date_convert($order->$key,3) !!}</td>
              @elseif($key=='payment_status')
                <td>{!! $payment_status_array[$order->$key] !!}</td>
              @else
                <td>{{ $order->$key }}</td>
              @endif

              
            @endforeach

            <td>
              <a href="{{ url('/admin/apply-form/view/'.$order->id) }}" title="View"><i class="fa fa-fw fa-eye"></i></a>
              <a href="{{ url('/admin/apply-form/delete/'.$order->id) }}" onclick="return confirm('Are you sure?');" title="Delete"><i class="fa fa-fw fa-close"></i></a>
            </td>

          </tr>
          @endforeach

          @else

          <tr>
            <td colspan="<?php echo count($column_array)+1;?>" align="middle">No Data Found</td>
          </tr>

          @endif
        </tbody>

      </table>

      <!--{{ $orders->links() }}-->

      {{$orders->appends(request()->input())->links()}}

          <!--{{ Request::query('orderby') }}<br>
          {{ Request()->orderby }}<br>
          {{ app('request')->input('orderby') }}-->

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->


@section('more-scripts')

@stop


@include('admin.footer')

