@include('frontend.header')

<?php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$states = DB::table('mf_state')->where('status','1')->orderBy('id', 'asc')->get();
$cities = DB::table('mf_city')->where('status','1')->orderBy('id', 'asc')->get();
$courses = DB::table('mf_course')->where('status','1')->orderBy('id', 'asc')->get();
$colleges = DB::table('mf_college')->where('status','1')->orderBy('city_id', 'asc')->get();
$partners = DB::table('mf_partner')->where('status','1')->orderBy('rank', 'asc')->get();
$news = DB::table('mf_news')->where('status','1')->latest()->paginate(4);
?>

<div class="home-slider">
  <div class="cycle-slideshow home-slideshow" data-cycle-slides="&gt; div" data-cycle-pager=".home-pager" data-cycle-timeout="5000" data-cycle-prev="#HomePrev" data-cycle-next="#HomeNext">
    <?php
    $banner_title='';
    $banner_sub_title='';
    $banner_body='';
    ?>
    @foreach($extra_data as $val)
      @if($val->type==1 && $val->image && File::exists(public_path('uploads/'.$val->image)) )
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
    <div class="slide" style="background-image:url({{ asset('/uploads/'.$val->image) }});"> </div>
      @endif
    @endforeach

  </div>
  <div class="container">
    <div class="home-pager"> </div>
  </div>
  <div class="textbox">
    <div class="container">
      <div class="caption">
        <div class="con">
          <h1>{!!$banner_title!!}</h1>
          @if($banner_sub_title) <p>{!!$banner_sub_title!!}</p>  @endif
          <div class="add_searchbox">
            <form action="{{url('/search')}}" method="get" enctype="multipart/form-data">
            <div class="addbox1">
             <select name="state" class="selectpicker" data-show-subtext="true" data-live-search="true">
                  <option value="">State</option>
                  @foreach($states as $val)
                    <option value="{!! $val->id !!}">{!! $val->name !!}</option>
                  @endforeach
              </select>
            </div>
            <div class="addbox2">
                <select name="course" class="selectpicker form-contral area" data-show-subtext="true" data-live-search="true">
                  <option value="">course you are</option>
                  @foreach($courses as $val)
                    <option value="{!! $val->id !!}">{!! $val->name !!}</option>
                  @endforeach
                  </select>
            </div>
             <button type="submit" class="searchButton">search</button>
           </form>
          </div>
        </div>
        <div class="add">
          {!!$banner_body!!}
          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-subscribe">Download</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!---bannerarea Us end--> 

@foreach($extra_data as $val)
  @if($val->type==2)
<!---About Us start-->
<div class="about_area">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-5">
        @if($val->image && File::exists(public_path('uploads/'.$val->image)) )<div class="about_thumlbe"><img src="{{ asset('/uploads/'.$val->image) }}" alt=""></div>@endif
      </div>
      <div class="col-lg-7 col-md-7">
        <div class="about_textbox">
          <h2><small>{!! $val->sub_title !!}</small> {!! $val->title !!}</h2>
          {!! $val->body !!}
          @if($val->btn_url) <a href="{!! $val->btn_url !!}" class="btn btn-outline-primary">{!! $val->btn_text !!}</a>@endif 
        </div>
      </div>
    </div>
  </div>
</div>
<!---About Us end--> 
  @endif
@endforeach

<!---Our Services  start -->

<div class="ourservices_area">
  <div class="container">
    @foreach($extra_data as $val)
      @if($val->type==3 && $val->image=='' && $val->image2=='')
    <h2>{!! $val->title !!}</h2>
    <div class="container_p">{{ $val->body }}</div>
      @endif
    @endforeach
  </div>
  <div class="blog_area">
    @foreach($extra_data as $val)
      @if($val->type==3 && $val->image!='' && $val->image2!='')
    <div class="blogmain_box clearfix">
      <div class="blog_imgthumblearea">
        @if($val->image && File::exists(public_path('uploads/'.$val->image)) )<div class="img_thumble" style="background-image:url({{ asset('/uploads/'.$val->image) }})"></div>@endif
      </div>
      <div class="blog_contantarea justify-content-end">
        <div class="valignCenter">
          @if($val->image2 && File::exists(public_path('uploads/'.$val->image2)) )<div class="icon"><img src="{{ asset('/uploads/'.$val->image2) }}" alt=""></div>@endif
          <h2>{!! $val->title !!}</h2>
          {!! $val->body !!}
        </div>
      </div>
    </div>    
      @endif
    @endforeach
  </div>
</div>

<!---Our Services  end --> 
<!---Top Colleges  start -->
<div class="topcolleges_area">
  <div class="container">
        <?php
          $btn_text='';
          $btn_url='';
        ?>
    @foreach($extra_data as $val)
      @if($val->type==4 && $val->image=='' && $val->image2=='')
        <?php
        if ($val->btn_text) {
          $btn_text=$val->btn_text;
        }
        if ($val->btn_url) {
          $btn_url=$val->btn_url;
        }
        ?>
    <h2>{!! $val->title !!}</h2>
    <div class="container_p">{!! $val->body !!}</div>
      @endif
    @endforeach
    <div class="row row-8">
      <?php
      $last_city_id = 0;
      $count =0;
      ?>
      @foreach($colleges as $val)
      <?php
      $count++;
      $all_courses = DB::table('mf_college_course')->where('college_id',$val->id)->orderBy('id', 'asc')->get();
      $collage_city = get_field_value('mf_city','name','id',$val->city_id);
      $collage_state = get_field_value('mf_state','name','id',$val->state_id);
      ?>
      @if($val->city_id!=$last_city_id)
      <?php
      $last_city_id = $val->city_id;
      ?>
      <div class="col-12 {!! $count>1?'mt-5':'' !!}">
        <div class="topcolleges_titel"> {{$collage_city}} : </div>
      </div>
      @endif
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="colleges_meadiabox card">
          <div class="thumble_area">@if($val->bannerimage && File::exists(public_path('uploads/'.$val->bannerimage)))<img src="{{ asset('/uploads/'.$val->bannerimage) }}" alt="">@endif
            <div class="clientlogo"> @if($val->logo && File::exists(public_path('uploads/'.$val->logo)))<img src="{{ asset('/uploads/'.$val->logo) }}" alt="">@endif </div>
          </div>
          <div class="colleges_body card-body">
            <h3><strong>{!!$currency_with_icon_array[$_SESSION['currency']]!!} {{number_format($all_courses[0]->price)}}</strong>{{get_field_value('mf_course','name','id',$all_courses[0]->course_id)}} - TOTAL FEES</h3>
            <h2>{{$val->college_name}} 
              - [{{$val->short_name}}], {{$collage_city}}</h2>
            <p><i class="fas fa-map-marker-alt"></i> {{$collage_city}}, {{$collage_state}}</p>
          </div>
          <div class="colleges_footer pt-0 pb-0 card-footer d-flex justify-content-between align-items-center"> <a href="{{url('college/'.$val->slug)}}" class="btn btn-link"> View All Course & Fees</a> <a href="{{url('college/'.$val->slug)}}" class="btn btn-primary"> Apply Now </a> </div>
        </div>
      </div>
      @endforeach
    </div>
    @if($btn_url) <a href="{!! $btn_url !!}" class="btn btn-college">{!! $btn_text !!}</a> </div>@endif
</div>
<!---Top Colleges  end --> 
<!---Top Courses  start -->
<div class="topcourses_area">
  <div class="container">
    @foreach($extra_data as $val)
      @if($val->type==5 && $val->image=='' && $val->image2=='')
    <h2>{!! $val->title !!}</h2>
    <div class="container_p">{!! $val->body !!}</div>
      @endif
    @endforeach
    <div class="row row-5">
      @foreach($courses as $val)
      <div class="col-lg-3 col-md-6 col-sm-6 col-12"> <a href="{{url('/search?course='.$val->id)}}">
        <div class="topcourses_box d-flex">
          <div class="thumble"> @if($val->image && File::exists(public_path('uploads/'.$val->image)) )<img src="{{ asset('/uploads/'.$val->image) }}" alt="">@endif </div>
          <div class="topcoursesboby">
            <h5>{!! $val->name !!}</h5>
            <p>Find out More >> </p>
          </div>
        </div>
        </a> 
      </div>
      @endforeach
    </div>
  </div>
</div>
<!---Top Courses  end --> 
<!--Our Partners start-->
<div class="ourpartners_area" style="background-image: url({{ asset('/frontend/images/ourpanterbg.jpg') }});">
  <div class="container">
    @foreach($extra_data as $val)
      @if($val->type==6 && $val->image=='' && $val->image2=='')
    <h2>{!! $val->title !!}</h2>
    <div class="container_p">{!! $val->body !!}</div>
      @endif
    @endforeach
    <div class="owl-carousel ourpartners-carousel">
      <div class="itembox">
        <?php $count = 0; ?>
        @foreach($partners as $val)
        @if($val->image && File::exists(public_path('uploads/'.$val->image)) )
        <?php 
        if ($count>0 && $count%3==0) {
          echo '</div><div class="itembox">';
        }
        $count++; 
        ?>
        <div class="patnerimgbox"><img src="{{asset('/uploads/'.$val->image)}}" alt="{{$val->name}}"></div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
</div>

<!--Our Partners end--> 

<!-- Admission News start -->
<div class="our_blogarea p-9">
  <div class="container">
    @foreach($extra_data as $val)
      @if($val->type==7 && $val->image=='' && $val->image2=='')
    <h2>{!! $val->title !!}</h2>
    <div class="container_p">{!! $val->body !!}</div>
      @endif
    @endforeach
    <div class="row">
      <?php $count = 0; ?>
      @foreach($news as $val)      
      <?php $count++; 
        $description = $val->description;
        $short_description = substr(strip_tags($description), 0,Short_Description_Length);
      ?>
      @if($count==1)
      <div class="col-lg-6 col-md-6">
        <div class="ourblog_box"> <a href="{{url('/news/'.$val->slug)}}">
          <div class="thumbule">@if($val->bannerimage && File::exists(public_path('uploads/'.$val->bannerimage)) )<img src="{{asset('/uploads/'.$val->bannerimage)}}" alt="">@endif </div>
          <div class="ourblog_body">
            <div class="dated"><i class="far fa-clock"></i> {!! date_convert($val->created_at,7) !!} </div>
            <h3>{!! $val->title !!}</h3>
            <p>{!! $short_description !!}</p>
            <div class="btn btn-link" >Read MORE >> </div>
          </div>
          </a> </div>
      </div>
      @else
      @if($count==2)
      <div class="col-lg-6 col-md-6 smallbologbox">
      @endif
        <div class="col-lg-12 ourblog_box">
          <div class="row row-0">
            <div class="col-lg-4">
              <div class="thumbule">@if($val->bannerimage && File::exists(public_path('uploads/'.$val->bannerimage)) )<img src="{{asset('/uploads/'.$val->bannerimage)}}" alt="">@endif </div>
            </div>
            <div class="col-lg-8">
              <div class="ourblog_body">
                <div class="dated"><i class="far fa-clock"></i> {!! date_convert($val->created_at,7) !!} </div>
                <h3>{!! $val->title !!}</h3>
                <a href="{{url('/news/'.$val->slug)}}" class=""><div class="btn btn-link" >Read MORE >> </div></a>
              </div>
            </div>
          </div>
        </div>

      @if($count==4)
      <?php $count = 0; ?>
      </div>
      @endif
      @endif
      @endforeach
      <?php  
      if ($count>1) {
        echo "</div>";
      }
      ?>
    </div>
  </div>
</div>
<!-- Admission News end --> 


@foreach($extra_data as $val)
  @if($val->type==8)
<!-- Downlad The App Today start -->
<div class="downladapp_area clearfix" style="background-image: url({{ asset('/frontend/images/downloadapp_bg.jpg') }});">
  <div class="container clearfix">
     @if($val->image && File::exists(public_path('uploads/'.$val->image)) )<div class="appbox"> <img src="{{ asset('/uploads/'.$val->image) }}" alt=""> </div>@endif
    <div class="apptext_box">
      <h2>{!! $val->title !!}</h2>
      <div class="container_ul">{!! $val->body !!}</div>
    </div>
  </div>
</div>
<!-- Downlad The App Today  end--> 
  @endif
@endforeach


@include('frontend.footer')
