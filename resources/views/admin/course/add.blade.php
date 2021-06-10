@include('admin.header')

@include('admin.sidebar')
<?php
$course_type_array = unserialize(Course_Type_Array); 
$course_subtype_array = unserialize(Course_Subtype_Array); 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Course
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add Course</li>
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
          <form role="form" action="{{ url('/admin/course/add/') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

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
                Course has been added successfully.
              </div>
              @endif

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="name" id="name" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ Request::old('name') }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ old('slug') }}" data-validation-engine="validate[required]">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Keyword</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_keyword" placeholder="Enter ...">{{ old('meta_keyword') }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_description" placeholder="Enter ...">{{ old('meta_description') }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Banner Image</label>
                <div class="col-sm-10">
                  <input type="file" name="bannerimage" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" >
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea name="description" class="ckeditor" placeholder="Enter ...">{{ old('description') }}</textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
              <div class="form-group clearfix">
                <label class="col-sm-4 control-label">Course For</label>
                <div class="col-sm-8">
                  <select name="course_type" id="course_type" class="form-control" data-validation-engine="validate[required]">
                    <option value="0">Select</option>
                    @foreach($course_type_array as $key => $value)
                    <option value="{{ $key }}" @if( Request::old('course_type')==$key) selected="selected" @endif >{!! $value !!}</option>
                    @endforeach
                    
                  </select>
                </div>
              </div>
                </div>
                <div class="col-sm-6">

              <div class="form-group clearfix course_subtype_con">
                <label class="col-sm-4 control-label">Course Type</label>
                <div class="col-sm-8">
                  <select name="course_subtype" id="course_subtype" class="form-control" data-validation-engine="validate[required]">
                    <option value="0">Select</option>
                    @foreach($course_subtype_array as $key => $value)
                    <option value="{{ $key }}" @if( Request::old('course_subtype')==$key) selected="selected" @endif >{!! $value !!}</option>
                    @endforeach
                    
                  </select>
                </div>
              </div>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Course Duration</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="completed_in" id="completed_in" data-validation-engine="validate[required,custom[integer]]" placeholder="Enter ..." value="{{ old('completed_in') }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" name="image" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" >
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!Request::old('status')=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!Request::old('status')=='0'?'selected':''!!}>Inactive</option>
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
$(document).ready(function() { 
  change_type();
  $('#course_type').change(function(){
    change_type();
  });
});
function change_type()
{
  var course_type = $("#course_type").val();
  $("#course_subtype").val(0);
  if (course_type>1) 
  {
    $('.course_subtype_con').show('slow');
  } else {
    $('.course_subtype_con').hide('slow');
  }
}
</script>
@stop

@include('admin.footer')
