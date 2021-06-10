@include('admin.header')

@include('admin.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View User
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">View User</li>
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
                User has been updated successfully.
              </div>
              @endif

              <div class="row">
                <div class="col-sm-9">

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Role</label>
                    <div class="col-sm-6">{!! get_field_value('roles','display_name','id',$user[0]->role_id) !!}</div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-6">{{$user[0]->name}} </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Username/Email</label>
                    <div class="col-sm-6">{{$user[0]->email}} </div>
                  </div>

                  @if($user[0]->phone_number!='')
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Phone Number</label>
                    <div class="col-sm-6">{{$user[0]->phone_number}} </div>
                  </div>
                  @endif

                  @if($user[0]->affiliation_id!='')
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Affiliation Status</label>
                    <div class="col-sm-6">{{$user[0]->affiliation_status ? 'Active' : 'Inactive'}} </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Affiliation Id</label>
                    <div class="col-sm-6">{{$user[0]->affiliation_id}} </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-3 control-label">Affiliation Commission</label>
                    <div class="col-sm-6">{{$user[0]->affiliation_commission}}% </div>
                  </div>
                  @endif


              @if ($user[0]->role_id!=1)
              @foreach($transactions as $transaction)
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Membership</label>
                  <div class="col-sm-8">{{$transaction->name}} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Membership Type</label>
                  <div class="col-sm-8">{{$transaction->membership_type}} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Start Date</label>
                  <div class="col-sm-8">{{date_convert($transaction->payment_date,3)}} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">End Date</label>
                  <div class="col-sm-8">{{date_convert($transaction->end_date,3)}} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Payment by</label>
                  <div class="col-sm-8">@if($transaction->payment_by==1) Paypal @elseif($transaction->payment_by==2) Stripe @else Admin @endif </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Transaction ID#</label>
                  <div class="col-sm-8">{{$transaction->transaction_id}} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Payment Amount</label>
                  <div class="col-sm-8">${{$transaction->payment_amount}} </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-3 control-label">Payment Status</label>
                  <div class="col-sm-8">{{$transaction->payment_status==1?'Paid':'Unpaid'}} </div>
                </div>
                <hr />
              @endforeach
              @endif
                  
                </div>
                <div class="col-sm-3">
                  <div class="pull-right clearfix">
                    <?php
                    if($user[0]->avatar && File::exists(public_path('uploads/'.$user[0]->avatar)) )
                      {
                        ?>
                        <img src="{{ url('/timthumb.php') }}?src={{ url('/uploads/'.$user[0]->avatar.'&w=200&h=200&zc=3') }}" style="margin: 10px 0 0 0;">
                        <?php
                      }
                      ?>                 
                  </div> 
                </div>                
              </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('/admin/user') }}'" >Back</button>
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


  @include('admin.footer')
