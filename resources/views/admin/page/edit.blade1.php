@include('admin.header')

@include('admin.sidebar')

<?php
$page_type_array = Page_Type_Array;
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
                  <input type="text" class="form-control" name="page_name" id="page_name" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{$page[0]->page_name}}">
                </div>
              </div>

              @if($page[0]->id!='1')
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="page_title" id="page_title" placeholder="Enter ..." value="{{$page[0]->page_title}}">
                </div>
              </div>
              @endif

              @if($page[0]->id=='1')

              <div class="form-group clearfix bannerimage">
                <label class="col-sm-2 control-label">Banner Image</label>
                <div class="col-sm-10">
                  <input type="file" name="banner_image" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]">
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                  <div class="clearfix">
                    <?php
                    if($page[0]->banner_image && File::exists(public_path('uploads/'.$page[0]->banner_image)) )
                      {
                        ?>
                        <img src="{{ {{ url('/uploads/'.$page[0]->banner_image) }}" style="margin: 10px 0 0 0;">
                        <?php
                      }
                      ?>
                    </div>

                </div>
              </div>
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
              
                @endif

                @if($page[0]->id!='1')
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Page Content</label>
                  <div class="col-sm-10">
                    <textarea name="body" class="summernote" placeholder="Enter ...">{{ $page[0]->body }}</textarea>
                  </div>
                </div>
                @endif


                @foreach($page_extra as $val)
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Content Type</label>
                  <div class="col-sm-10">
                    <select name="page_type[]" class="form-control page_type" data-validation-engine="validate[required]">
                      <option value="">Select</option>
                      @foreach($page_type_array as $k => $p)
                      <option value="{{$k}}" {!! $val->page_type==$k?'selected':'' !!}>{{$p}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="section_page_extra">
                  @if($val->page_type=='1') 
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Section Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_title_{{$val->id}}" placeholder="Enter ..." value="{{$val->title}}">
                    </div>
                  </div>
                  @endif
                </div>
                @endforeach




                @if($page[0]->id=='1')
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Banner Text</label>
                  <div class="col-sm-10">
                    <textarea name="bannertext" id="bannertext" class="form-control" placeholder="Enter ...">{{ $page[0]->bannertext }}</textarea>
                  </div>
                </div>
                @endif

              @if($page[0]->id=='1')
                <?php $type=''; $i=0;?>
                  <div class="section_1">
                @foreach($page_extra as $val)
                  @if($val->type!=4 && $val->type!=7)
                  <?php
                  if ($type=='' || $type!=$val->type) {    $i++;
                    if ($type!='' && $type!=$val->type) {
                      echo '</div><div class="section_'.$val->type.'">';
                    }          
                  ?>
                  <div class="box-header with-border">
                    <h3 class="box-title">Section 
                      @if($val->type==1) About 
                      @elseif($val->type==2) Benefit
                      @elseif($val->type==3) Map and Site Listing
                      @elseif($val->type==5) Sign UP
                      @elseif($val->type==6) FAQ
                      @else {{$i}} 
                      @endif 
                    </h3>
                  </div>
                  <?php
                  }
                  $type = $val->type
                  ?>
                @if($val->id==56 || $val->id==57)
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Section Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_title_{{$val->id}}" placeholder="Enter ..." value="{{$val->title}}">
                    </div>
                  </div>
                @else
                  @if($val->type==2 || $val->type==3 || $val->type==4 || $val->type==5 || $val->type==6)
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_title_{{$val->id}}" placeholder="Enter ..." value="{{$val->title}}">
                    </div>
                  </div>
                  @endif
                  @if($val->type==2)
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
                            <img src="{{ url('/timthumb.php') }}?src={{ url('/uploads/'.$val->image.'&w=95&h=95&zc=3') }}" style="margin: 10px 0 0 0;">
                        <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                  @endif
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                      <textarea name="section_body_{{$val->id}}" class="summernote" placeholder="Enter ...">{{$val->body}}</textarea>
                    </div>
                  </div>
                  @endif
                @endif
                @endforeach
                  </div>

                <?php $type='';?>
                  <div class="section_4 section_faq">
                  <div class="box-header with-border">
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
                      <textarea name="section_body_{{$val->id}}" class="summernote" placeholder="Enter ...">{{$val->body}}</textarea>
                    </div>
                  </div>
                  @endif
                @endforeach
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="col-sm-10"><a href="javascript:;" class="btn btn-default add_faq_button">Add more FAQ</a></div>
                  </div>

                <?php $logo_counter=0;?>
                  <div class="section_7 section_logo">
                  <div class="box-header with-border">
                    <h3 class="box-title">Section Collaborators</h3>
                  </div>
                @foreach($page_extra as $val)
                  @if($val->type==7)
                  <?php $logo_counter++;?>
                  @if($logo_counter==1)
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="section_title_{{$val->id}}" placeholder="Enter ..." value="{{$val->title}}">
                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                      <textarea name="section_body_{{$val->id}}" class="summernote" placeholder="Enter ...">{{$val->body}}</textarea>
                    </div>
                  </div>
                  @endif
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
                            <img src="{{ url('/timthumb.php') }}?src={{ url('/uploads/'.$val->image.'&w=200&h=200&zc=3') }}" style="margin: 10px 0 0 0;"> <a href="{{ url('/admin/page/remove_image/'.$val->id) }}"> Remove</a>
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


  @include('admin.footer')

<script type="text/javascript">
$(document).ready(function() {
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
}
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
      $(wrapper).append('<div><div class="form-group clearfix"><label class="col-sm-2 control-label">Title</label><div class="col-sm-9"><input type="text" class="form-control" name="section_faq_new_t[]" placeholder="Enter ..." value="" data-validation-engine="validate[required]"></div><div class="col-sm-1"><a href="#" class="remove_field">Remove</a></div></div><div class="form-group clearfix"><label class="col-sm-2 control-label">Section Content</label><div class="col-sm-10"><textarea name="section_faq_new_c[]" class="summernote" style="width: 100%;min-height: 100px;" placeholder="Enter ..."></textarea></div></div></div>'); //add input box
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

