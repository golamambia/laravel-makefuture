@include('frontend.header')

<?php
$all_courses = DB::table('mf_college_course')->where('college_id',$college->id)->orderBy('id', 'asc')->get();
$collage_city = get_field_value('mf_city','name','id',$college->city_id);
$collage_state = get_field_value('mf_state','name','id',$college->state_id);
$all_images = DB::table('mf_college_image')->where('college_id',$college->id)->orderBy('id', 'asc')->get();
$faculties = DB::table('mf_college_faculty')->where('college_id',$college->id)->orderBy('id', 'asc')->get();
$news = DB::table('mf_news')->whereRaw('status="1" and (college_id="'.$college->id.'" or college_id="0")')->inRandomOrder()->limit(4)->get();
?>

<div class="subbanner_area" style="background-image:url({!! ($college->bannerimage && File::exists(public_path('uploads/'.$college->bannerimage)))?asset('/uploads/'.$college->bannerimage):'' !!});">
  <div class="container">
    <div class="darea">
      <div class="dimg">@if($college->logo && File::exists(public_path('uploads/'.$college->logo)))<img src="{{asset('/uploads/'.$college->logo)}}" alt=" ">@endif</div>
      <div class="dtxt">
        <h3>{!! $college->college_name !!} <span>- {!! $college->short_name !!} {!!$collage_city!!}</span></h3>
        <ul>
          <li><i class="fas fa-map-marker-alt"></i> {!!$collage_city!!}, {!!$collage_state!!},</li>
          @if($college->estd_info)<li><i class="fas fa-city"></i> {!! $college->estd_info !!},</li>@endif
          @if($college->rank_info)<li><i class="fas fa-building"></i> {!! $college->rank_info !!}</li>@endif
        </ul>
      </div>
    </div>
  </div>
</div>
<!------- details area start -------->
<section class="main_area details_area">
  <div class="container">
    <div class="details_box_one">
      <div class="row">
        <div class="col-lg-8">
          <div class="details_image_area">
            <ul class="nav nav-tabs">
              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#menu1">Photos</a> </li>
              @if($college->map)<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#menu2">Map</a> </li>@endif
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="menu1">
                <div class="details_image_area">
                  <div id="big" class="owl-carousel owl-theme">
                  	@foreach($all_images as $key => $val)
                  	@if($val->image && File::exists(public_path('uploads/'.$val->image)))
                    <div class="item"> <img src="{{asset('/uploads/'.$val->image)}}" alt=""> </div>
                    @endif
                    @endforeach
                  </div>
                  <div id="thumbs" class="owl-carousel owl-theme">
                  	@foreach($all_images as $key => $val)
                  	@if($val->image && File::exists(public_path('uploads/'.$val->image)))
                    <div class="item"> <img src="{{asset('/uploads/'.$val->image)}}" alt=""> </div>
                    @endif
                    @endforeach
                  </div>
                </div>
              </div>
              @if($college->map)<div class="tab-pane" id="menu2">
                <div class="map_box">
                  {!! $college->map !!}
                </div>
              </div>@endif
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="top_categories">
            <h3 class="heading"> <img src="{{asset('/frontend/images/icon7.png')}}" alt="icon" title="" class="icon"> Top Courses </h3>
            <ul>
			<?php
			$count =0;
			?>
            @foreach($all_courses as $key => $val)
			<?php
			$count++;
			$course = get_fields_value('mf_course','id',$val->course_id);
			?>
              <li> {{$count}}. {{$course[0]->name}} <strong class="year">>> {{$course[0]->completed_in}} Years</strong> </li>
              @endforeach
            </ul>
          </div>
          <a href="{{url('apply-form?state_id='.$college->state_id.'&college_id='.$college->id)}}" class="btn btn-primary w-100 mb-3">Apply Now</a> @if($college->brochure && File::exists(public_path('uploads/'.$college->brochure)))<a href="{{asset('/uploads/'.$college->brochure)}}" class="btn btn-link w-100" download>Download Brochure</a>@endif </div>
      </div>
    </div>
    <div class="details_description">
      <ul class="nav nav-tabs">
        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1">INFO</a> </li>
        @if($college->course_fee)<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2">Courses & Fees</a> </li>@endif
        @if($college->admission)<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3">Admission {!!date('Y')!!}</a> </li>@endif
        @if($college->placement)<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab4">Placement</a> </li>@endif
        @if($college->hostel)<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab5">Hostel</a> </li>@endif
        @if($college->news_articles)<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab6">News & Articles</a> </li>@endif
      </ul>
      <div class="tab-content">
        <div id="tab1" class="tab-pane active">
          <div class="details_description_contain">
            {!! $college->description !!}
          </div>
        </div>
        <div id="tab2" class="tab-pane">
          <div class="details_description_contain">
            {!! $college->course_fee !!}
          </div>
        </div>
        <div id="tab3" class="tab-pane">
          <div class="details_description_contain">
            {!! $college->admission !!}
          </div>
        </div>
        <div id="tab4" class="tab-pane">
          <div class="details_description_contain">
            {!! $college->placement !!}
          </div>
        </div>
        <div id="tab5" class="tab-pane">
          <div class="details_description_contain">
            {!! $college->hostel !!}
          </div>
        </div>
        <div id="tab6" class="tab-pane">
          <div class="details_description_contain">
            {!! $college->news_articles !!}
          </div>
        </div>
      </div>
    </div>
    
    <!------ details bottom area start ----->
    <div class="details_bottom_area">
      <div class="row">
        <div class="col-lg-8">
          <div class="details_search_description">
            <div class="search_heading">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search Courses...">
                <div class="search_icon"><img src="{{asset('/frontend/images/icon10.png')}}" alt="search icon" title=""></div>
              </div>
            </div>
            <div class="details_search_description_body">
              <div class="w-100 mb-2">
                <div class="d-flex justify-content-start">
                  <div class="select_degree">
                    <h4>select degree :</h4>
                  </div>
                  <div class="select_degree">
                    <label class="check_degree">
                      <input type="checkbox" name="">
                      <span>PGPBA</span> </label>
                  </div>
                  <div class="select_degree">
                    <label class="check_degree">
                      <input type="checkbox" name="">
                      <span>Fellowship</span> </label>
                  </div>
                  <div class="select_degree">
                    <label class="check_degree">
                      <input type="checkbox" name="">
                      <span>Ph.D</span> </label>
                  </div>
                  <div class="select_degree">
                    <label class="check_degree">
                      <input type="checkbox" name="">
                      <span>PGP-PPM</span> </label>
                  </div>
                  <div class="select_degree">
                    <label class="check_degree">
                      <input type="checkbox" name="">
                      <span>Executive</span> </label>
                  </div>
                </div>
              </div>
              <div class="w-100">
                <div class="d-flex justify-content-start">
                  <div class="select_degree">
                    <h4>select Stream :</h4>
                  </div>
                  <div class="select_degree">
                    <label class="check_degree">
                      <input type="checkbox" name="" checked>
                      <span>Management</span> </label>
                  </div>
                  <div class="select_degree">
                    <label class="check_degree">
                      <input type="checkbox" name="">
                      <span>Arts</span> </label>
                  </div>
                  <div class="select_degree">
                    <label class="check_degree">
                      <input type="checkbox" name="">
                      <span>Science</span> </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="details_search_description_body">
              <h3>Post Graduate Programme in Enterprise Management [PGPEM]</h3>
              <ul class="description_list">
                <li><img src="{{asset('/frontend/images/icon11.png')}}" alt="icon" title="" class="list_icon">2 year</li>
                <li><img src="{{asset('/frontend/images/icon12.png')}}" alt="icon" title="" class="list_icon">degree</li>
                <li><img src="{{asset('/frontend/images/icon13.png')}}" alt="icon" title="" class="list_icon">on campus</li>
                <li><img src="{{asset('/frontend/images/icon14.png')}}" alt="icon" title="" class="list_icon">post graduation</li>
              </ul>
              <h4><strong>Exams Accepted</strong> : CAT | GMAT | GRE</h4>
              <h4><strong>Ranking</strong> : #2 Management - NIRF</h4>
              <h4><strong>1 Streams</strong> : Enterprise Management</h4>
              <div class="total_fees_box"> <a href="#" class="btn">Admission Guide 2021</a> <a href="#" class="btn2">Download Brochure</a>
                <div class="fees">
                  <h5>total fees</h5>
                  <h6><i class="fas fa-rupee-sign"></i> 1,850,000</h6>
                </div>
              </div>
            </div>
            <div class="details_search_description_body">
              <h3>Post Graduate Programme in Enterprise Management [PGPEM]</h3>
              <ul class="description_list">
                <li><img src="{{asset('/frontend/images/icon11.png')}}" alt="icon" title="" class="list_icon">2 year</li>
                <li><img src="{{asset('/frontend/images/icon12.png')}}" alt="icon" title="" class="list_icon">degree</li>
                <li><img src="{{asset('/frontend/images/icon13.png')}}" alt="icon" title="" class="list_icon">on campus</li>
                <li><img src="{{asset('/frontend/images/icon14.png')}}" alt="icon" title="" class="list_icon">post graduation</li>
              </ul>
              <h4><strong>Exams Accepted</strong> : CAT | GMAT | GRE</h4>
              <h4><strong>Ranking</strong> : #2 Management - NIRF</h4>
              <h4><strong>1 Streams</strong> : Enterprise Management</h4>
              <div class="total_fees_box"> <a href="#" class="btn">Admission Guide 2021</a> <a href="#" class="btn2">Download Brochure</a>
                <div class="fees">
                  <h5>total fees</h5>
                  <h6><i class="fas fa-rupee-sign"></i> 1,850,000</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="news_box">
            <h3 class="news_heading"><img src="{{asset('/frontend/images/icon8.png')}}" alt="icon" title="" class="icon">news</h3>
            <ul>
              @foreach($news as $val) 
              <li>
                <div class="img_box">@if($val->bannerimage && File::exists(public_path('uploads/'.$val->bannerimage)) )<img src="{{asset('/uploads/'.$val->bannerimage)}}" alt="{!! $val->title !!}" title="">@endif
                  <div class="mask"></div>
                </div>
                <a href="{{url('/news/'.$val->slug)}}">{!! $val->title !!}</a>
                <div class="week">{!! date_convert($val->created_at,7) !!}</div>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="news_box">
            <h3 class="news_heading"><img src="{{asset('/frontend/images/icon9.png')}}" alt="icon" title="" class="icon">FACULTIES</h3>
            <ul class="faculties_list">
              @foreach($faculties as $key => $val)
              <li> <a href="{{url('college/faculty/'.$val->slug)}}">{!! $val->title !!}</a>
                <div class="week">{!! $val->designation !!}</div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!------ details bottom area stop -----> 
    
  </div>
</section>
<!------- details area stop --------> 

@include('frontend.footer')