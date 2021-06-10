@include('admin.header')

@include('admin.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Email Template
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Email Template</li>
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
          <!-- form start -->
          <form type="form" action="{{ url('/admin/emailtemplate') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

            @csrf

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
                Email Template has been edited successfully.
              </div>
              @endif
                @if (session()->has('delete_success'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Success</h4>
                  Image has been deleted successfully.
                </div>
                @endif


                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Regsitration Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="registration_email" id="registration_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->registration_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Email#} => Email, {#Firstname#} => User First name, {#Password#} => New Password, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Forgot Password Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="forgotpass_email" id="forgotpass_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->forgotpass_email}}</textarea>
                    <small>{#ResetPasswordLink#} => Reset Password Link, {#Fullname#} => User Full name, {#Sitename#} => Site Title</small>
                  </div>
                </div> 

                <!-- <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Password Change Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="password_change_email" id="password_change_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->password_change_email}}</textarea>
                    <small>{#Password#} => New Password, {#Fullname#} => User Full name, {#Sitename#} => Site Title</small>
                  </div>
                </div> -->

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Account Approved Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="account_approved_email" id="account_approved_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->account_approved_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Email#} => Email, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Order Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_email" id="order_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->order_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Email#} => Email, {#Statename#} => State name, {#Collegename#} => College name, {#Academicyear#} => Academic year, {#Coursename#} => Course name, {#TransactionID#} => Transaction ID, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Order Email To Admin</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_email_to_admin" id="order_email_to_admin" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->order_email_to_admin}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Email#} => Email, {#Statename#} => State name, {#Collegename#} => College name, {#Academicyear#} => Academic year, {#Coursename#} => Course name, {#TransactionID#} => Transaction ID, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div>

                <!-- <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Job Accept Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_accept_email" id="order_accept_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->order_accept_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Firstname#} => User First name, {#Email#} => Email, {#OrderID#} => Order ID, {#ProofreaderFullname#} => Proofreader Fullname, {#MyOrderurl#} => My Order URL, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div> -->

                <!-- <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Order Complete Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_complete_email" id="order_complete_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->order_complete_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Firstname#} => User First name, {#Email#} => Email, {#OrderID#} => Order ID, {#ProofreaderFullname#} => Proofreader Fullname, {#MyOrderurl#} => My Order URL, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div> -->

                <!-- <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Order Complete Email To Admin</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_complete_email_to_admin" id="order_complete_email_to_admin" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->order_complete_email_to_admin}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Firstname#} => User First name, {#Email#} => Email, {#OrderID#} => Order ID, {#ProofreaderFullname#} => Proofreader Fullname, {#MyOrderurl#} => My Order URL, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div> -->

                <!-- <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Order Cancel Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_cancel_email" id="order_cancel_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->order_cancel_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Firstname#} => User First name, {#Email#} => Email, {#OrderID#} => Order ID, {#MyOrderurl#} => My Order URL, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div> -->

                <!-- <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Release Request Settled Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="release_request_approved_email" id="release_request_approved_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate[0]->release_request_approved_email}}</textarea>
                    <small>{#Fullname#} => User name, {#Earningamount#} => Earning amount, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div>  -->

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
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