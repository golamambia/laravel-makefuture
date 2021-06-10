@include('frontend.header')
<?php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$college_type_array = unserialize(College_Type_Array);
$bannerimage = asset('/frontend/images/innerbanner1.jpg');
$states = DB::table('mf_state')->where('status','1')->orderBy('id', 'asc')->get();
$cities = DB::table('mf_city')->where('status','1')->orderBy('id', 'asc')->get();
$courses = DB::table('mf_course')->where('status','1')->orderBy('id', 'asc')->get();
?>

<div class="subbanner_area" style="background-image:url({!! $bannerimage !!});">
  <div class="container">
    <h2>Listing of  <strong>College & Course</strong></h2>
  </div>
</div>



<!------- listing area start -------->
<section class="main_area listing_main_area">
  <div class="container">
    <div class="listing_search_area">
      <div class="d-flex justify-content-between">
        <div class="listing_search_box">
          <form action="{{url('/search')}}" method="get" enctype="multipart/form-data">
            <input type="hidden" name="view" value="{!! Request()->view=='grid'?'grid':'list' !!}">
          <div class="d-flex justify-content-start">
            <div class="form-group">
              <input type="text" class="from-control" placeholder="Keyword Search" name="s" value="{!! Request()->s !!}">
            </div>
            <div class="form-group">
                  <select name="course" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    <option value="">Course Type</option>
                  @foreach($courses as $val)
                    <option value="{!! $val->id !!}" {!! Request()->course==$val->id?'selected':'' !!}>{!! $val->name !!}</option>
                  @endforeach
                  </select>
            </div>
            <div class="form-group">
              <input type="text" class="from-control" placeholder="Collage Name" name="collage_name" value="{!! Request()->collage_name !!}">
            </div>
            <div class="form-group border-0">
                  <select name="state" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    <option value="">State</option>
                  @foreach($states as $val)
                    <option value="{!! $val->id !!}" {!! Request()->state==$val->id?'selected':'' !!}>{!! $val->name !!}</option>
                  @endforeach
                    
                  </select>
            </div>
            <button type="submit" class="btn btn-primary">SEARCH</button>
          </div>
          </form>
        </div>
        <div class="page_listing">
          <ul class="listing_grid">
            <li><a href="{{$page_url}}?view=grid"><img src="{{ asset('/frontend/images/grid1.jpg') }}"></a></li>
            <li><a href="{{$page_url}}"><img src="{{ asset('/frontend/images/grid2.jpg') }}"></a></li>
          </ul>
          <ul class="listing_page">
            <li>{{ $colleges->currentPage() }}</li>
            <li>of {{ $colleges->lastPage() }}</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3">
        <div class="listing_filter_box">
          <h3>Course Categories</h3>
          <ul>
            @foreach($courses as $val)
            <li><a href="{{url('/search?course='.$val->id)}}">{!! $val->name !!}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="listing_filter_box">
          <h3>college</h3>
          <ul>
            @foreach($college_type_array as $key => $val)
            <li><a href="{{url('/search?college_type='.$val)}}">{{$val}}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="listing_filter_box">
          <h3>Durations</h3>
          <ul>
            <li><a href="{{url('/search?duration=1-2')}}">1 Years - 2 Years</a></li>
            <li><a href="{{url('/search?duration=2-3')}}">2 Years - 3 Years</a></li>
            <li><a href="{{url('/search?duration=3-4')}}">3 Years - 4 Years</a></li>
            <li><a href="{{url('/search?duration=4plus')}}">4 Years +</a></li>
          </ul>
        </div>
        <!-- <div class="listing_filter_box">
            <h3>location</h3>
            <div class="form-group">
              <select class="from-control">
                <option>Bangalore, Karnataka</option>
              </select>
            </div>
          </div> --> 
      </div>
      <div class="col-lg-9">
        @if(Request()->view=='grid')
        <div class="row">
        @endif
        @foreach($colleges as $key => $val)
        <?php
          $description = $val->description;
          $short_description = substr(strip_tags($description), 0,Short_Description_Length);
        ?>
        @if(Request()->view=='grid')
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="colleges_meadiabox card">
            <div class="thumble_area">@if($val->bannerimage && File::exists(public_path('uploads/'.$val->bannerimage)))<img src="{{ asset('/uploads/'.$val->bannerimage) }}" alt="">@endif
              <div class="clientlogo"> @if($val->logo && File::exists(public_path('uploads/'.$val->logo)))<img src="{{ asset('/uploads/'.$val->logo) }}" alt="">@endif </div>
            </div>
            <div class="colleges_body card-body">
              <h3><strong>{!!$currency_with_icon_array[$_SESSION['currency']]!!} {!!number_format($val->price)!!}</strong>{!!$val->course_name!!} - TOTAL FEES</h3>
              <h2>{!!$val->college_name!!} 
                - [{!!$val->short_name!!}], {!!$val->city_name!!}</h2>
              <p><i class="fas fa-map-marker-alt"></i> {!!$val->city_name!!}, {!!$val->state_name!!}</p>
            </div>
            <div class="colleges_footer pt-0 pb-0 card-footer d-flex justify-content-between align-items-center"> <a href="{{url('college/'.$val->slug)}}" class="btn btn-link"> View All Course & Fees</a> <a href="{{url('college/'.$val->slug)}}" class="btn btn-primary"> Apply Now </a> </div>
          </div>
        </div>
        @else
        <div class="listing_box">
          <a href="{{url('college/'.$val->slug)}}"><div class="listing_image">@if($val->bannerimage && File::exists(public_path('uploads/'.$val->bannerimage)))<img src="{{ asset('/uploads/'.$val->bannerimage) }}">@endif
            <div class="mask"></div>
          </div>
          <h3> {!!$val->college_name!!}
            <div class="price"><i class="fas fa-rupee-sign"></i> {!!number_format($val->price)!!}</div>
          </h3></a>
          <h4><img src="{{ asset('/frontend/images/icon15.png') }}" class="icon">{!!$val->city_name!!}, {!!$val->state_name!!}</h4>
          <ul class="date_time_list">
            <li> <img src="{{ asset('/frontend/images/icon16.png') }}" alt="icon" class="list_icon"> {!! date_convert($val->updated_at,8) !!} </li>
            <!-- <li> <img src="{{ asset('/frontend/images/icon17.png') }}" alt="icon" class="list_icon"> 30/50 Student </li> -->
          </ul>
          <!-- <h5><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></h5> -->
          <p><strong>Description:</strong> {!! $short_description !!}</p>
        </div>
        @endif
        @endforeach
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-lg-3"></div>
      <div class="col-lg-9">
        {{$colleges->appends(request()->input())->links()}}
      </div>
    </div>
  </div>
</section>
<!------- listing area stop --------> 

@include('frontend.footer')