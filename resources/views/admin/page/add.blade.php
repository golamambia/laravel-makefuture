@include('admin.header')

@include('admin.sidebar')
@php
$page_display_in_array = unserialize(Page_Display_In_Array);
$display_in=0;
if(old('menu_order')>0)
{
  $menu_order = old('menu_order');
}else{
  $header_menu = get_fields_value_where('pages',"parent_id='0'",'menu_order','desc');
  $menu_order = $header_menu[0]->menu_order+1;
}
@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Page
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add Page</li>
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
          <form role="form" action="{{ url('/admin/page/add/') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

            @csrf

            <input type="hidden" name="id" value="0">

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
                Page has been added successfully.
              </div>
              @endif

              @if (session()->has('remove_image_success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Success</h4>
                Image has been removed successfully. 
              </div>
              @endif

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="page_name" id="page_name" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ old('page_name') }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Enter ..." value="{{ old('page_title') }}">
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ old('slug') }}" data-validation-engine="validate[required]">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-10">
                  <select name="parent_id" class="form-control">
                    <option value="0">Select Parent</option>
                @foreach($all_pages as $key => $value)
                <option value="{!! $value->id !!}" @if($value->id==old('parent_id')) selected @endif>{!! $value->page_name !!}</option>
                @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Display in</label>
                <div class="col-sm-10">
                @foreach($page_display_in_array as $key => $value)
                <label>
                  <input type="radio" name="display_in" class="flat-red" value="{{$key}}" @if($key==$display_in) checked @endif>
                  {!! $value !!} &nbsp;&nbsp;
                </label>
                @endforeach
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Menu Order</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="menu_order" id="menu_order" placeholder="Enter ..." value="{{ $menu_order }}" data-validation-engine="validate[required,custom[integer]]">
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

                <div class="form-group clearfix bannerimage">
                  <label class="col-sm-2 control-label">Banner Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="bannerimage" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" >
                    Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Page Content</label>
                  <div class="col-sm-10">
                    <textarea name="body" class="ckeditor" placeholder="Enter ...">{{ old('body') }}</textarea>
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


  @include('admin.footer')

<script type="text/javascript">
$("#module_name").blur(function(){
  if($("#module_slug").val().trim()==""){
    var slug_array = $("#module_name").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
    slug_array = filter_array(slug_array);
    $("#module_slug").val(slug_array.join("-"));
  }
});

$("#module_slug").blur(function(){
  if($("#module_slug").val().trim()==""){
    var slug_array = $("#module_name").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
    slug_array = filter_array(slug_array);

    $("#module_slug").val(slug_array.join("-"));
  }else{
    var slug_array = $("#module_slug").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
    slug_array = filter_array(slug_array);
    $("#module_slug").val(slug_array.join("-"));
  }
});
</script>


