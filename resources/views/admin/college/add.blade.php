@include('admin.header')

@include('admin.sidebar')
<?php
$college_type_array = unserialize(College_Type_Array);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add College
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add College</li>
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
          <form role="form" action="{{ url('/admin/college/add/') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

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
                College has been added successfully.
              </div>
              @endif

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">College Type</label>
                <div class="col-sm-10">
                  <select name="college_type[]" class="form-control select2" multiple>                
                    @foreach($college_type_array as $key => $val)
                    <?php
                    $selected='';
                    if (old('college_type')) {
                      if (in_array($val,old('college_type'))) {
                        $selected='selected';
                      }
                    }
                    ?>
                    <option value="{{$val}}" {{$selected}}>{{$val}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">College Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="college_name" id="college_name" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ Request::old('college_name') }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Short Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="short_name" id="short_name" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ Request::old('short_name') }}">
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
                <label class="col-sm-2 control-label">Logo</label>
                <div class="col-sm-10">
                  <input type="file" name="logo" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" >
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Gallery Image</label>
                <div class="col-sm-10">
                  <input type="file" name="galleryimage[]" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" multiple>
                  Mime Type: jpeg,png,jpg,gif,svg <br>

                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Brochure</label>
                <div class="col-sm-10">
                  <input type="file" name="brochure" data-validation-engine="validate[,custom[validateMIME[doc|docx|pdf|image/jpeg|image/jpg]]]" >
                  Mime Type: doc,docx,pdf,jpg,jpeg, Max image upload size 5 Mb<br>

                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                  <select name="state_id" id="state_id" class="form-control" data-validation-engine="validate[required]">
                    <option value="">Select</option>

                    @foreach($states as $state)
                    <option value="{{ $state->id }}" @if( Request::old('state_id')==$state->id) selected="selected" @endif >{{ $state->name }}</option>
                    @endforeach
                    
                  </select>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                  <select name="city_id" id="city_id" class="form-control" data-validation-engine="validate[required]">
                    <option value="">Select</option>                    
                  </select>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">ESTD Information</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="estd_info" id="estd_info" placeholder="Enter ..." value="{{ old('estd_info') }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Rank Information</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="rank_info" id="rank_info" placeholder="Enter ..." value="{{ old('rank_info') }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Map</label>
                <div class="col-sm-10">
                  <textarea name="map" class="form-control" placeholder="Enter ...">{{ old('map') }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea name="description" class="ckeditor" placeholder="Enter ...">{{ old('description') }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Course Fee</label>
                <div class="col-sm-10">
                  <textarea name="course_fee" class="ckeditor" placeholder="Enter ...">{{ old('course_fee') }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Admission</label>
                <div class="col-sm-10">
                  <textarea name="admission" class="ckeditor" placeholder="Enter ...">{{ old('admission') }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Placement</label>
                <div class="col-sm-10">
                  <textarea name="placement" class="ckeditor" placeholder="Enter ...">{{ old('placement') }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Hostel</label>
                <div class="col-sm-10">
                  <textarea name="hostel" class="ckeditor" placeholder="Enter ...">{{ old('hostel') }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">News Articles</label>
                <div class="col-sm-10">
                  <textarea name="news_articles" class="ckeditor" placeholder="Enter ...">{{ old('news_articles') }}</textarea>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Course <button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button></label>
                
                <div class="col-sm-10">
                  <div class="after-add-more"></div>
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

<!-- Copy Fields -->
<div class="copy hide">
  <div class="row control-group" style="margin-top:10px">
      <div class="col-md-6"> 
        <select name="course_id[]" class="form-control" data-validation-engine="validate[required]">
          <option value="">Select</option>
          @foreach($courses as $course)
          <option value="{{ $course->id }}" >{{ $course->name }}</option>
          @endforeach          
        </select>
      </div>
      <div class="col-md-5">                      
        <input type="text" class="form-control" name="price[]" placeholder="Price" value="" data-validation-engine="validate[required]">
      </div>
      <div class="col-md-1">
        <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
      </div>
  </div>
</div>

@section('more-scripts')

<script>
$(function(){
  $('.copy').hide();
  //$(".add-more").click(function(){
  $("body").on("click",".add-more",function(){ 
      //$('.copy').show();
      var html = $(".copy").html();
      $(".after-add-more").append(html);
  });
  $("body").on("click",".remove",function(){ 
      $(this).parents(".control-group").remove();
  });
});
</script>
<script type="text/javascript">
function state_change()
{
  var state_id = $("#state_id").val(); 
  var city_id = '{{old("city_id")}}';
  var data = {'state_id' : state_id,'city_id':city_id};

  $.ajax({
    type : 'get',
    url : '{{url("ajax/get-city")}}',
    data : data,
    dataType : 'json',
    beforeSend : function(){
      //$("#loading").show();
    },
    success : function(result){
      //$("#loading").hide();
      console.log(result);
      $("#city_id").empty().html(result);
    }
  }); 
}

$(document).ready(function(){
  state_change();
  $('#state_id').change(function(){
    state_change();
  });
});
</script>

@stop

@include('admin.footer')
