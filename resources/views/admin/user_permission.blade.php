
@include('admin.header')

@include('admin.sidebar')

@php
$sub_admin_access_array = unserialize(Sub_Admin_Access_Array);
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      User Permission
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">User Permission</li>
    </ol>
  </section>

<link rel="stylesheet" href="{{ asset("/admin_lte/plugins/icheck-1.0.3/skins/all.css") }}">
  
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
          <form type="form" action="{{ url('/admin/user_permission') }}"  method="post" enctype="multipart/form-data" class="formvalidation" id="user_permission">

            @csrf

            <div class="box-body">
              <div class="ajaxmessage"></div>

              @foreach($roles as $role)
              <?php
              $add_module = $role->add_module?explode(',', $role->add_module):array();
              $edit_module = $role->edit_module?explode(',', $role->edit_module):array();
              $view_module = $role->view_module?explode(',', $role->view_module):array();
              $delete_module = $role->delete_module?explode(',', $role->delete_module):array();
              ?>
              <h3 class="box-title">{{ $role->display_name }}</h3>
              <div class="form-group clearfix">
                <div class="col-sm-12">
                          <input type="hidden" name="add_module[{{$role->id}}][]" value="test">
                          <input type="hidden" name="edit_module[{{$role->id}}][]" value="test">
                          <input type="hidden" name="view_module[{{$role->id}}][]" value="test">
                          <input type="hidden" name="delete_module[{{$role->id}}][]" value="test">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <th>Module</th>
                      <th>Add</th>
                      <th>Edit</th>
                      <th>View</th>
                      <th>Delete</th>
                    </thead>
                    <tbody>
                      @foreach($sub_admin_access_array as $key => $value)
                      <tr>
                        <th>{{$value}}</th>
                        <td>
                          @if($key!='dashboard' && $key!='order' && $key!='transaction' && $key!='payment_request' && $key!='earning')
                          <input type="checkbox" class="minimal1 access_icheckbox" name="add_module[{{$role->id}}][]" value="{{$key}}" @if(in_array($key,$add_module)) checked @endif>
                          <label></label>
                          @endif
                        </td>
                        <td>
                          @if($key!='dashboard' && $key!='transaction' && $key!='earning')
                          <input type="checkbox" class="minimal1 access_icheckbox" name="edit_module[{{$role->id}}][]" value="{{$key}}" @if(in_array($key,$edit_module)) checked @endif>
                          <label></label>
                          @endif
                        </td>
                        <td>
                          <input type="checkbox" class="minimal1 access_icheckbox" name="view_module[{{$role->id}}][]" value="{{$key}}" @if(in_array($key,$view_module)) checked @endif>
                          <label></label>
                        </td>
                        <td>
                          @if($key!='dashboard' && $key!='payment_request' && $key!='earning')
                          <input type="checkbox" class="minimal1 access_icheckbox" name="delete_module[{{$role->id}}][]" value="{{$key}}" @if(in_array($key,$delete_module)) checked @endif>
                          <label></label>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              @endforeach
              


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

<script>
$(document).ready(function(){
  $('.access_icheckbox').each(function(){
    var self = $(this),
      label = self.next(),
      label_text = label.text();
    label_text_checked = 'Allow';
    label_text_unchecked = 'Denied';
    icheckbox_class_blue = 'icheckbox_line-blue';
    icheckbox_class_red = 'icheckbox_line-red';
    if ($(this).prop('checked')==true) {
      label_text1 = label_text_checked;
      icheckbox_class = icheckbox_class_blue;
    }else{
      label_text1 = label_text_unchecked;
      icheckbox_class = icheckbox_class_red;
    }

    label.remove();
    self.iCheck({
      checkboxClass: icheckbox_class,
      radioClass: 'iradio_line',
      insert: '<div class="icheck_line-icon"></div><span>' + label_text1+'</span>'
    }).on('ifChanged', function(e) {
      // Get the field name
      var isChecked = e.currentTarget.checked;

      if (isChecked == true) {
        // alert(label_text_checked);
        $(this).siblings('span').text(label_text_checked);
        $(this).parent().removeClass(icheckbox_class_red);
        $(this).parent().addClass(icheckbox_class_blue);
      }else{
        // alert(label_text_unchecked);
        $(this).siblings('span').text(label_text_unchecked);
        $(this).parent().removeClass(icheckbox_class_blue);
        $(this).parent().addClass(icheckbox_class_red);
      }
      //$("#user_permission").submit();
    });
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $("#user_permission").submit(function(e) {
    e.preventDefault();
      var data = $("#user_permission").serialize();
      $.ajax({
        type : 'post',
        url : '{{url("admin/ajax/user-permission")}}',
        data : data,
        dataType : 'json',
        beforeSend : function(){
          //$("#loading").show();
        },
        success : function(result){
          //$("#loading").hide();
          console.log(result);
          var ajaxmessage = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4><i class="icon fa fa-ban"></i> Alert!</h4>'+result.msg+'</div>';
          if (result.type=='1') {
            ajaxmessage = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4><i class="icon fa fa-ban"></i> Alert!</h4>'+result.msg+'</div>';
          }
          $(".ajaxmessage").empty().html(ajaxmessage);
          $(".ajaxmessage").show().delay(5000).fadeOut();
        }
      });
  });
});
</script>

@stop

@include('admin.footer')