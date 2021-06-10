@include('admin.header')

@include('admin.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Faculty
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Faculty</li>
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
          <form role="form" action="{{ url('/admin/college/faculty/update/') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

            @csrf

            <input type="hidden" name="id" value="{{$faculty->id}}">

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
                Faculty has been updated successfully.
              </div>
              @endif

              @if (session()->has('file_destroy'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Success</h4>
                {!! Session::get('file_destroy')!!}
              </div>
              @endif

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">College</label>
                <div class="col-sm-10">
                  <select name="college_id" id="college_id" class="form-control" data-validation-engine="validate[required]">
                    <option value="">Select</option>

                    @foreach($colleges as $college)
                    <option value="{{ $college->id }}" @if( $faculty->college_id==$college->id) selected="selected" @endif >{{ $college->college_name }}</option>
                    @endforeach
                    
                  </select>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="title" id="title" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ $faculty->title }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ $faculty->slug }}" data-validation-engine="validate[required]">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Designation</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="designation" id="designation" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ $faculty->designation }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Keyword</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_keyword" placeholder="Enter ...">{{ $faculty->meta_keyword }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_description" placeholder="Enter ...">{{ $faculty->meta_description }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Banner Image</label>
                <div class="col-sm-10">
                  <input type="file" name="bannerimage" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" >
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>
                  <div class="clearfix">
                    <?php if($faculty->bannerimage && File::exists(public_path('uploads/'.$faculty->bannerimage)) ) { ?>
                      <img src="{{ asset('/uploads/'.$faculty->bannerimage) }}" style="margin: 10px 0 0 0;max-width: 200px;"> <a href="{{url('/admin/college/faculty/file-destroy/'.$faculty->id)}}"><i class="fa fa-fw fa-close"></i></a>
                    <?php } ?>
                  </div>

                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea name="description" class="ckeditor" placeholder="Enter ...">{{ $faculty->description }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!$faculty->status=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!$faculty->status=='0'?'selected':''!!}>Inactive</option>
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


  @include('admin.footer')
