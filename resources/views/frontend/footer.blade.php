@php
$footer_menu = get_fields_value_where('pages',"(display_in='2' or display_in='3')",'menu_order','asc');
@endphp
<?php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$college_type_array = unserialize(College_Type_Array);
$courses = DB::table('mf_course')->where('status','1')->orderBy('id', 'asc')->get();
?>

<!-- footer css Start -->
<footer class="footer" style="background-image:url({{ asset('/frontend/images/footerbg.jpg') }});">
  <div class="footer_top">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
          <div class="footer_wizget">
            <div class="footer_logo"> <img src="{!! ( config('site.logo') && File::exists(public_path('uploads/'.config('site.logo'))) ) ? asset('/uploads/'.config('site.logo')) : asset('/frontend/images/logomain.png') !!}" alt=""> </div>
            <ul class="footerapplogo">
              <li><a href="#"><img src="{{ asset('/frontend/images/applogo.png') }}" alt=""></a></li>
              <li><a href="#"><img src="{{ asset('/frontend/images/applogo1.png') }}" alt=""></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
              <div class="footer_wizget">
                <h3>Quick <span>Links</span></h3>
                <ul class="footermenu">
                  @foreach($footer_menu as $menu)
                  <li><a href="{!! url('/'.($menu->id=='1'?'':$menu->slug)) !!}">{!!$menu->page_title?$menu->page_title:$menu->page_name!!}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
              <div class="footer_wizget">
                <h3>Our <span>Courses</span></h3>
                <ul class="footermenu">
                  @foreach($courses as $val)
                  <li><a href="{{url('/search?course='.$val->id)}}">{!! $val->name !!}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
              <div class="footer_wizget">
                <h3>Our <span>Colleges</span></h3>
                <ul class="footermenu">
                  @foreach($college_type_array as $key => $val)
                  <li><a href="{{url('/search?college_type='.$val)}}">{{$val}}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
              <div class="footer_wizget">
                <h3>Contact <span>Us</span></h3>
                <ul class="footeradress">
                  <li><strong>Location : </strong> {!!config('site.address')!!} </li>
                  <li><strong>Phone : </strong> {!!config('site.phone')!!} </li>
                  <li><strong>Email : </strong> {!!config('site.email')!!} </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <ul class="footersocalbox">
        @if(config('site.facebook_link'))<li><a href="{!!config('site.facebook_link')!!}"><i class="fab fa-facebook-f" target="_blank"></i></a></li>@endif
        @if(config('site.twitter_link'))<li><a href="{!!config('site.twitter_link')!!}"><i class="fab fa-twitter"></i></a></li>@endif
        @if(config('site.google_plus_link'))<li><a href="{!!config('site.google_plus_link')!!}"><i class="fab fa-google-plus-g"></i></a></li>@endif
        @if(config('site.instagram_link'))<li><a href="{!!config('site.instagram_link')!!}"><i class="fab fa-instagram"></i></a></li>@endif
      </ul>
    </div>
  </div>
  <div class="footer_bottom">
    <div class="container">
      <p>Copyright © {{ date('Y') }} <a href="{{ url('/') }}">College Portal.</a> All rights reserved.</p>
      <!-- <p>Design & Development By: <a href="http://webtechnomind.com/" target="_blank">Webtechnomind IT Solutions</a></p> -->
    </div>
  </div>
</footer>
<!-- footer css stop --> 

<!-- Modal -->
<div class="modal fade modal-center" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="far fa-times-circle"></i></span></button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{ url('enquiry-popup') }}" class="customvalidation" enctype="multipart/form-data">
                @csrf
        <div class="d-flex">
          <div class="modalleftbox">
            <h3>How makefuturetoday helps you in
              Admission</h3>
            <div class="about_thumlbe"> <img src="{{ asset('/frontend/images/aboutimg1.jpg') }}" alt="#"> </div>
          </div>
          <div class="flex-grow-1 modalrightbox">
            <h4><strong> Register Now To Apply</strong> Please Register now</h4>
            @if($errors->any())   
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            @foreach ($errors->all() as $error)
            {{ $error }}<br>
            @endforeach
            </div>
            @endif
            <div class="row row-5">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Full Name <span class="check">*</span></label>
                  <div class="form-group">
                    <input type="text" class="form-control" value="" placeholder="Full Name" name="fullname" data-validation-engine="validate[required]">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Email Address <span class="check">*</span></label>
                  <div class="form-group">
                    <input type="text" class="form-control" value="" placeholder="Email Address" name="email" data-validation-engine="validate[required,custom[email]]">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Mobile Number <span class="check">*</span></label>
                  <div class="form-group">
                    <input type="text" class="form-control" value="" placeholder="Mobile Number" name="mobile" data-validation-engine="validate[required]">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                  <label>City You Live In</label>
                  <div class="form-group">
                    <input type="text" class="form-control" value="" placeholder="City You Live In" name="city">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                  <label>State You Live In <span class="check">*</span></label>
                  <div class="form-group">
                    <input type="text" class="form-control" value="" placeholder="State You Live In" name="state" data-validation-engine="validate[required]">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Top Courses</label>
                  <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="course">
                    @foreach($courses as $val)
                    <option value="{!! $val->name !!}">{!! $val->name !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="submit" name="submit" value="submit" class="btn btn-primary">
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal --> 

<!-- Alert Message Modal -->
<div class="modal fade" id="alertMessage" tabindex="-1" role="dialog" aria-labelledby="alertMessage" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content" style="max-width: 610px;">
      <div class="modal-body">
        <h5 class="modal-title title">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <div class="clearfix"></div>
        <div class="content"></div>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">      
      <div class="modal-body">
        <h4 class="title"></h4>   
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <div class="clearfix"></div>
        <div class="content text-center">
          
        </div>
        <div class="modal-footer">
          <button class="btn btnTxt" data-dismiss="modal" aria-hidden="true">Cancel</button>
          <a class="btn" id="dataConfirmOK">Delete</a>
        </div>
      </div>      
    </div>
  </div>
</div>

<script src="{{ asset("/frontend/js/jquery.min.js") }}"></script> 
<script src="{{ asset("/frontend/js/popper.min.js") }}"></script> 
<script src="{{ asset("/frontend/js/bootstrap.min.js") }}"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script> 
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script> 
<script src="{{ asset("/frontend/js/jquery.extra.js") }}"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script> 

<!-- Validation JS -->
<script src="{{ asset("/frontend/js/jquery.validationEngine.min.js") }}"></script>
<script src="{{ asset("/frontend/js/jquery.validationEngine-en.js") }}"></script>
<script>
  function customvalidation()
  {
    jQuery(".customvalidation").validationEngine('attach', {
      relative: true,
      overflownDIV:"#divOverflown",
      promptPosition:"topLeft"
    });
    jQuery(".customvalidation_bottom").validationEngine('attach', {
      relative: true,
      overflownDIV:"#divOverflown",
      promptPosition:"bottomLeft"
    });
  }
  customvalidation();

  var confirmModal = function(){
    $('#deleteModal .modal-body .content').html($(this).attr('data-confirm'));
    $('#deleteModal .title').html($(this).attr('data-title'));
    $('#dataConfirmOK').attr('href',$(this).attr('href'));
    $('#deleteModal').modal('show');
    return false;
  };

  $('body').on('click', 'a[data-confirm]', confirmModal);

</script>

@if(Session::has('message')) 
<script>
  $(document).ready(function() {  
    $("#alertMessage .title").hide();
    $("#alertMessage .content").empty().html('{!! Session::get('message')!!}');
    $("#alertMessage").modal('show');
    setTimeout(function() { $('#alertMessage').modal('hide'); }, {!! config('site.message_show_time')*1000 !!});
  });
</script>
@endif

<script>
/*$(window).ready (function () {
  setTimeout (function () {
    $ ('#modal-subscribe').modal ("show")
  }, 10000)
});*/
</script>

@yield('more-scripts')

</body>
</html>