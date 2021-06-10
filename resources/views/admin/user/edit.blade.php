@include('admin.header')

@include('admin.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit User
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit User</li>
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
          <form role="form" action="{{ url('/admin/user/update/') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

            @csrf

            <input type="hidden" name="id" value="{{$user[0]->id}}">

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

      @if(Session::has('error'))  
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {{ Session::get('error')}}
      </div>
      @endif
               @if (session()->has('message'))
               <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Success</h4>
                {{ Session::get('message') }}
              </div>
              @endif 

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Role</label>
                <div class="col-sm-10">
                  <select name="role_id" id="role_id" class="form-control" style="width: 100%;" data-validation-engine="validate[required]">
                    <option value="">Select</option>

                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if( $user[0]->role_id==$role->id) selected="selected" @endif >{{ $role->display_name }}</option>
                    @endforeach
                    
                  </select>
                </div>
              </div> 

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="f_name" id="fname" data-validation-engine="validate[required]" placeholder="Enter name..." value="{!!$user[0]->first_name!!}">
                </div> 
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Surname</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="l_name" id="lname" data-validation-engine="validate[required]" placeholder="Enter last name..." value="{!!$user[0]->last_name !!}">
                </div>
              </div> 

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" id="email" data-validation-engine="validate[required,custom[email]]" placeholder="Enter ..." value="{{$user[0]->email}}">
                </div>
              </div> 

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                  <input type="file" name="avatar">
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                  <div class="clearfix">
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

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Enter ..." name="password" id="password" data-validation-engine="validate[,custom[password]]]" autocomplete="off"/>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Retype Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Enter ..." name="password_confirmation" id="password_confirmation" data-validation-engine="validate[,equals[password]]" autocomplete="off"/>
                  </div>
                </div> 

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter ..." name="phone_number" id="phone_number" value="{{$user[0]->phone_number}}" />
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                  <textarea name="address" class="form-control">{{$user[0]->address}}</textarea>
                </div>
              </div>
              <div class="form-group clearfix franchise">
                <label class="col-sm-2 control-label">Aadhaar Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter ..." name="aadhaar_number" id="aadhaar_number" value="{{$user[0]->aadhaar_number}}" />
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!$user[0]->status=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!$user[0]->status=='0'?'selected':''!!}>Inactive</option>
                    <option value="1" {!!$user[0]->status=='2'?'selected':''!!}>Deleted</option>
                  </select>
                </div>
              </div> 

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


@section('more-scripts')

<script type="text/javascript">

role_change();

function role_change()
{
  var role_id = $("#role_id").val();
  if (role_id==3) 
  {
    $('.franchise').hide('slow');
    $('.student').show('slow');
  }
  else if(role_id==2) 
  {
    $('.student').hide('slow');
    $('.franchise').show('slow');
  } else {
    $('.student').hide('slow');
    $('.franchise').hide('slow');
  }
  
}

$(document).ready(function(){
  $('#role_id').change(function(){
    role_change();
  });
});
</script> 

@stop


  @include('admin.footer')
