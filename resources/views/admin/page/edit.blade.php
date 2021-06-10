@include('admin.header')

@include('admin.sidebar')
@php
$page_display_in_array = unserialize(Page_Display_In_Array);
@endphp

<?php
if ($page[0]->body2!='') {
  if ($page[0]->id==1) {
    $body2 = unserialize($page[0]->body2);
    // print_r($body2);
    // $section1_1='';
    $section1=isset($body2['section1'])? $body2['section1'][0]:array();
    $section2= isset($body2['section2'])? $body2['section2'][0]:array();
    $section3=isset($body2['section3'])? $body2['section3'][0]:array();
    $section4= isset($body2['section4'])? $body2['section4'][0]:array();
    $section1_1=$body2['section1'][0][0];
    $section1_2=$body2['section1'][0][1];
    $section2_1='';
    $section2_2='';
    $section2_3='';
  }
}else{
  $section1=array();
  $section2=array();
  $section3=array();
  $section4=array();
  $section1_1='';
  $section1_2='';
  $section2_1='';
  $section2_2='';
  $section2_3='';
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Page
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Page</li>
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
          <form role="form" action="{{ url('/admin/page/update/') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

            @csrf

            <input type="hidden" name="id" value="{{$page[0]->id}}">

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
                Page has been updated successfully.
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
                  <input type="text" class="form-control module_name" name="page_name" id="page_name" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{$page[0]->page_name}}">
                </div>
              </div>

              @if($page[0]->id!='1')
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Enter ..." value="{{$page[0]->page_title}}">
                </div>
              </div>
              @endif

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ $page[0]->slug }}" data-validation-engine="validate[required]" @if('5'==$page[0]->id || '9'==$page[0]->id || '1'==$page[0]->id) readonly @endif>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-10">
                  <select name="parent_id" class="form-control">
                    <option value="0">Select Parent</option>
                @foreach($all_pages as $key => $value)
                <option value="{!! $value->id !!}" @if($value->id==$page[0]->parent_id) selected @endif>{!! $value->page_name !!}</option>
                @endforeach
                  </select>
                </div>
              </div>


              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Display in</label>
                <div class="col-sm-10">
                @foreach($page_display_in_array as $key => $value)
                <label>
                  <input type="radio" name="display_in" class="flat-red" value="{{$key}}" @if($key==$page[0]->display_in) checked @endif>
                  {!! $value !!} &nbsp;&nbsp;
                </label>
                @endforeach
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Menu Order</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="menu_order" id="menu_order" placeholder="Enter ..." value="{{ $page[0]->menu_order }}" data-validation-engine="validate[required,custom[integer]]">
                </div>
              </div>

              @if($page[0]->id=='1')
                <div class="form-group clearfix bannerimage">
                  <label class="col-sm-2 control-label">Banner Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="bannerimage[]" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" multiple>
                    Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

              <?php
              $banner_title='';
              $banner_sub_title='';
              $banner_body='';
              ?>
              @foreach($page_extra as $val)
                @if($val->type==1)
                  <?php
                  if ($val->title) {
                    $banner_title=$val->title;
                  }
                  if ($val->sub_title) {
                    $banner_sub_title=$val->sub_title;
                  }
                  if ($val->body) {
                    $banner_body=$val->body;
                  }
                  ?>
                    <div class="clearfix">
                      <?php
                      if($val->image && File::exists(public_path('uploads/'.$val->image)) )
                        {
                          ?>
                          <img src="{{ asset('/uploads/'.$val->image) }}" style="margin: 10px 0 0 0;max-width: 300px;">  <a href="{{ url('admin/page-extra/delete/'.$val->id) }}"><i class="fa fa-fw fa-close"></i></a>
                          <?php
                        }
                        ?>
                      </div>
                @endif
              @endforeach

                  </div>
                </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Banner Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="banner_title" placeholder="Enter ..." value="{{$banner_title}}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Banner Sub Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="banner_sub_title" placeholder="Enter ..." value="{{$banner_sub_title}}">
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Banner Right Content</label>
                <div class="col-sm-10">
                  <textarea name="banner_body" class="form-control ckeditor" placeholder="Enter ...">{!! $banner_body !!}</textarea>
                </div>
              </div>

              <!-- <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Button Text</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="btn_text" placeholder="Enter ..." value="{{ $page[0]->btn_text }}">
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Button URL</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="btn_url" placeholder="Enter ..." value="{{ $page[0]->btn_url }}">
                </div>
              </div> -->
              @else

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Keyword</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_keyword" placeholder="Enter ...">{{ $page[0]->meta_keyword }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_description" placeholder="Enter ...">{{ $page[0]->meta_description }}</textarea>
                </div>
              </div>

                <div class="form-group clearfix bannerimage">
                  <label class="col-sm-2 control-label">Banner Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="bannerimage" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" >
                    Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                @if($page[0]->bannerimage!='')
                    <div class="clearfix">
                      <?php
                      if($page[0]->bannerimage && File::exists(public_path('uploads/'.$page[0]->bannerimage)) )
                        {
                          ?>
                          <img src="{{ asset('/uploads/'.$page[0]->bannerimage) }}" style="margin: 10px 0 0 0;max-width: 300px;">
                          <?php
                        }
                        ?>
                      </div>
                @endif

                  </div>
                </div>
              
              @endif

                @if($page[0]->id!='1' && $page[0]->id!='2' && $page[0]->id!='3')
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Page Content</label>
                  <div class="col-sm-10">
                    <textarea name="body" class="ckeditor" placeholder="Enter ...">{!! $page[0]->body !!}</textarea>
                  </div>
                </div>
                @endif

                <?php $type=''; $i=$content_count=0;?>
                  <div class="section_1">
                @foreach($page_extra as $val)
                  @if(($val->type!=1 && ($page[0]->id!='2' || $val->type!=7)))
                  <?php
                  if ($type=='' || $type!=$val->type) {    $i++;
                    if ($type!='' && $type!=$val->type) {
                      $content_count=0;
                      echo '</div><div class="section_'.$val->type.'">';
                    }
                  ?>
                  <div class="box-header with-border" style="margin-bottom: 15px;">
                    <h3 class="box-title">Section 
                      @if($val->type==11) Section 
                      @elseif($val->type==3 && $page[0]->id=='2') Our Mission
                      @elseif($val->type==3) Services
                      @elseif($val->type==4 && $page[0]->id=='2') Our Vision
                      @elseif($val->type==4) College
                      @elseif($val->type==5 && $page[0]->id=='2') Our Portfolio
                      @elseif($val->type==5 && $page[0]->id=='3') Enquiry
                      @elseif($val->type==5) Course
                      @elseif($val->type==6) Partners
                      @elseif($val->type==7) News
                      @elseif($val->type==8) App
                      @else {{$i}} 
                      @endif 
                    </h3>
                  </div>
                  <?php
                  }
                    $content_count++;
                  $type = $val->type
                  ?>
                  @if($val->type==2 || $val->type==3 || $val->type==4 || $val->type==5 || $val->type==6 || $val->type==7 || $val->type==8)
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">{!! (($val->type==2 || $val->type==3) && $content_count=='1' && $page[0]->id!='2' && $page[0]->id!='4')?"Section ":'' !!}Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_title_{{$val->id}}" placeholder="Enter ..." value="{{$val->title}}">
                    </div>
                  </div>
                  @endif

                  @if(($val->type==2 && $content_count>0))
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Sub Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_sub_title_{{$val->id}}" placeholder="Enter ..." value="{{$val->sub_title}}">
                    </div>
                  </div>
                  @endif

                  @if(($val->type==3 && $content_count>1 && $page[0]->id=='1') || ($val->type==3 && $page[0]->id=='3') || ($val->type==2 && $page[0]->id=='2'))
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">{!! (($val->type==3 && $content_count>1) || ($val->type==3 && $page[0]->id=='3'))?"Icon ":'Image' !!}</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="section_file2_{{$val->id}}" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]">
                      Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                      <div class="clearfix">
                        <?php
                        if($val->image2 && File::exists(public_path('uploads/'.$val->image2)) )
                          {
                            ?>
                            <img src="{{ url('/timthumb.php') }}?src={{ asset('/uploads/'.$val->image2.'&w=95&h=95&zc=3') }}" style="margin: 10px 0 0 0;">
                        <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if(($val->type==2) || ($val->type==3 && $content_count>1 && $page[0]->id=='1') || (($val->type==3 || $val->type==4) && $page[0]->id=='2') || (($val->type==3) && $page[0]->id=='3'))
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="section_file_{{$val->id}}" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]">
                      Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                      <div class="clearfix">
                        <?php
                        if($val->image && File::exists(public_path('uploads/'.$val->image)) )
                          {
                            ?>
                            <img src="{{ url('/timthumb.php') }}?src={{ asset('/uploads/'.$val->image.'&w=95&h=95&zc=3') }}" style="margin: 10px 0 0 0;">
                        <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if(($val->type==2 && $content_count>0) || ($val->type==3) || ($val->type==4) || ($val->type==5) || ($val->type==6) || ($val->type==7) || ($val->type==8) || ($val->type==1 && $page[0]->id=='2'))
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                      <textarea name="section_body_{{$val->id}}" class="ckeditor" placeholder="Enter ...">{!!$val->body!!}</textarea>
                    </div>
                  </div>
                  @endif
                  @if(($val->type==2 && $page[0]->id!='2') || ($val->type==4) || ($page[0]->id=='4' && $content_count=='3'))
                  @if($val->type==4 && $page[0]->id=='2')
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">{!! ($val->type==4 && $page[0]->id=='2')?'Video URL':'Button URL' !!}</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_btn_url_{{$val->id}}" placeholder="Enter ..." value="{{ $val->btn_url }}">
                    </div>
                  </div>
                  @else
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Button Text</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_btn_text_{{$val->id}}" placeholder="Enter ..." value="{{ $val->btn_text }}">
                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">{!! ($val->type==4 && $page[0]->id=='2')?'Video URL':'Button URL' !!}</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_btn_url_{{$val->id}}" placeholder="Enter ..." value="{{ $val->btn_url }}">
                    </div>
                  </div>
                  @endif
                  @endif
                  @endif
                @endforeach
                  </div>

              @if($page[0]->id=='3')
                <?php /*$type='';?>
                  <div class="section_4 section_faq">
                  <div class="box-header with-border" style="margin-bottom: 15px;">
                    <h3 class="box-title">FAQs</h3>
                  </div>
                @foreach($page_extra as $val)
                  @if($val->type==4)
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Questions</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_title_{{$val->id}}" placeholder="Enter ..." value="{{$val->title}}">
                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Answer</label>
                    <div class="col-sm-10">
                      <textarea name="section_body_{{$val->id}}" class="ckeditor" placeholder="Enter ...">{{$val->body}}</textarea>
                    </div>
                  </div>
                  @endif
                @endforeach
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="col-sm-10"><a href="javascript:;" class="btn btn-default add_faq_button">Add more FAQ</a></div>
                  </div>
                <?php */ ?>
              @endif

              @if($page[0]->id=='2')
                <?php $logo_counter=0;?>
                  <div class="section_7 section_logo">
                  <div class="box-header with-border">
                    <h3 class="box-title">Portfolio Images</h3>
                  </div>
                @foreach($page_extra as $val)
                  @if($val->type==7)
                  <?php $logo_counter++;?>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Image {{$logo_counter }}</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="section_file_{{$val->id}}" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]">
                      Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                      <div class="clearfix">
                        <?php
                        if($val->image && File::exists(public_path('uploads/'.$val->image)) )
                          {
                            ?>
                            <img src="{{ url('/timthumb.php') }}?src={{ url('/uploads/'.$val->image.'&w=200&h=200&zc=3') }}" style="margin: 10px 0 0 0;"> <a href="{{ url('admin/page-extra/delete/'.$val->id) }}"> Remove</a>
                        <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="col-sm-10"><a href="javascript:;" class="btn btn-default add_logo_button">Add more Image</a></div>
                  </div>
              @endif

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

<div class="image_container_copy hide">  
  <div class="form-group clearfix bannerimage">
    <label class="col-sm-2 control-label">Banner Image</label>
    <div class="col-sm-9">
      <input type="file" name="bannerimage" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]">
      Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>
    </div>
    <div class="col-sm-1"><a href="#" class="remove_field">Remove</a></div>
  </div>
</div>

@include('admin.footer')

<script type="text/javascript">
/*$(document).ready(function() {
  $("#bannertype").change(function(){
    change_bannertype(this.value);
  });
  change_bannertype({{$page[0]->bannertype}});
});

function change_bannertype(val){
  if (val==1) {
    $(".bannerimage").show('slow');
    $(".image2").hide('slow');
  }else{
    $(".bannerimage").hide('slow');
    $(".image2").show('slow');
  }  
}*/
</script>

<script type="text/javascript">
$(document).ready(function() {
  var max_fields      = 10; //maximum input boxes allowed
  var wrapper       = $(".section_faq"); //Fields wrapper
  var add_button      = $(".add_faq_button"); //Add button ID
  
  var x = 0; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div><div class="form-group clearfix"><label class="col-sm-2 control-label">Title</label><div class="col-sm-9"><input type="text" class="form-control" name="section_faq_new_t[]" placeholder="Enter ..." value="" data-validation-engine="validate[required]"></div><div class="col-sm-1"><a href="#" class="remove_field">Remove</a></div></div><div class="form-group clearfix"><label class="col-sm-2 control-label">Section Content</label><div class="col-sm-10"><textarea name="section_faq_new_c[]" class="ckeditor" style="width: 100%;min-height: 100px;" placeholder="Enter ..."></textarea></div></div></div>'); //add input box
    }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //Company click on remove text
    e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
  })
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  var max_fields1      = 10; //maximum input boxes allowed
  var wrapper1       = $(".section_logo"); //Fields wrapper
  var add_button1      = $(".add_logo_button"); //Add button ID
  
  var x = 0; //initlal text box count
  $(add_button1).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields1){ //max input box allowed
      x++; //text box increment
      $(wrapper1).append('<div class="form-group clearfix"><label class="col-sm-2 control-label">Image</label><div class="col-sm-9"><input type="file" class="form-control" name="section_logo_new_i[]" data-validation-engine="validate[required,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]"></div><div class="col-sm-1"><a href="#" class="remove_field1">Remove</a></div></div>'); //add input box
    }
  });
  
  $(wrapper1).on("click",".remove_field1", function(e){ //Company click on remove text
    e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
  })
});
</script>

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
