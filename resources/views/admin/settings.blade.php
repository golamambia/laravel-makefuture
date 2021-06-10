@php
$site_title = "";
$site_logo = "";
$site_logo2 = "";
$admin_pagination = "";
$site_pagination = "";
$site_meta_title = "";
$site_meta_keyword = "";
$site_meta_description = "";
$site_meta_image = "";

if( isset($settings) ):
    foreach ($settings as $set):
        $key = str_replace('.', '_', $set->key);
        $$key = $set->value;
    endforeach;
endif;
@endphp

@include('admin.header')

@include('admin.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      General Settings
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">General Settings</li>
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
          <form type="form" action="{{ url('/admin/settings') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

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
                General Settings has been edited successfully.
              </div>
              @endif
                @if (session()->has('delete_success'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Success</h4>
                  File has been deleted successfully.
                </div>
                @endif

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Site Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_title" id="site_title" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ $site_title }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Site Logo</label>
                <div class="col-sm-10">
                  <input type="file" name="site_logo">
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                  <div class="clearfix">
                    <?php
                    if($site_logo && File::exists(public_path('uploads/'.$site_logo)) )
                      {
                        ?>
                        <img src="{{ url('/uploads/'.$site_logo) }}" style="margin: 10px 0 0 0; max-width: 200px;">
                        <?php
                      }
                      ?>
                    </div>

                  </div>
                </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Site Logo 2</label>
                <div class="col-sm-10">
                  <input type="file" name="site_logo2">
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                  <div class="clearfix">
                    <?php
                    if($site_logo2 && File::exists(public_path('uploads/'.$site_logo2)) )
                      {
                        ?>
                        <img src="{{ url('/uploads/'.$site_logo2) }}" style="margin: 10px 0 0 0;">
                        <?php
                      }
                      ?>
                    </div>

                  </div>
                </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Contact Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_contact_email" id="site_contact_email" data-validation-engine="validate[required,custom[email]]" placeholder="Enter ..." value="{{ $site_contact_email }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Support Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_support_email" id="site_support_email" data-validation-engine="validate[required,custom[email]]" placeholder="Enter ..." value="{{ $site_support_email }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Site Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_email" id="site_email" data-validation-engine="validate[required,custom[email]]" placeholder="Enter ..." value="{{ $site_email }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Site Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_phone" id="site_phone" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ $site_phone }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Site Address</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="site_address" placeholder="Enter ...">{{ $site_address }}</textarea>
                </div>
              </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Admin Pagination</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="admin_pagination" id="admin_pagination" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ $admin_pagination }}">
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">instagram_link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_instagram_link" id="site_instagram_link" data-validation-engine="validate[required]" placeholder="Enter ..." value="{{ $site_pagination }}">
                  </div>
                </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_meta_title" placeholder="Enter ..." value="{{ $site_meta_title }}">
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Keyword</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="site_meta_keyword" placeholder="Enter ...">{{ $site_meta_keyword }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="site_meta_description" placeholder="Enter ...">{{ $site_meta_description }}</textarea>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">Meta Image</label>
                <div class="col-sm-10">
                  <input type="file" name="site_meta_image">
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>

                  <div class="clearfix">
                    <?php
                    if($site_meta_image && File::exists(public_path('uploads/'.$site_meta_image)) )
                      {
                        ?>
                        <img src="{{ url('/uploads/'.$site_meta_image) }}" style="margin: 10px 0 0 0;width: 50%;">
                        <a href="{{ url('/admin/settings/delete/site_meta_image') }}"><i class="fa fa-fw fa-close"></i></a>
                        <?php
                      }
                      ?>
                    </div>

                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Facebook Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_facebook_link" id="site_facebook_link" placeholder="Enter ..." value="{!!config('site.facebook_link')!!}" data-validation-engine="validate[custom[url]]">
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Twitter Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_twitter_link" id="site_twitter_link" placeholder="Enter ..." value="{!!config('site.twitter_link')!!}" data-validation-engine="validate[custom[url]]">
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Google-Plus Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_google_plus_link" id="site_google_plus_link" placeholder="Enter ..." value="{!!config('site.google_plus_link')!!}" data-validation-engine="validate[custom[url]]">
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Instagram Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_instagram_link" id="site_instagram_link" placeholder="Enter ..." value="{!!config('site.instagram_link')!!}" data-validation-engine="validate[custom[url]]">
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">Message Show Time</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_message_show_time" id="site_message_show_time" placeholder="Enter ..." value="{!!config('site.message_show_time')!!}" data-validation-engine="validate[custom[integer]]">
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

order_email();

function order_email()
{
  var site_order_email_option = $("input[name=site_order_email_option]:checked").val();
  if (site_order_email_option=='yes') 
  {
    $('.site_order_email').show('slow');
  } else {
    $('.site_order_email').hide('slow');
  }
  
}

$(document).ready(function(){
  $('input[name=site_order_email_option]').click(function(){
    order_email();
  });
}); 
</script> 

@stop

@include('admin.footer')