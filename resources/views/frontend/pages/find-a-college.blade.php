@include('frontend.header')

<?php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$states = DB::table('mf_state')->where('status','1')->orderBy('id', 'asc')->get();
$cities = DB::table('mf_city')->where('status','1')->orderBy('id', 'asc')->get();
$courses = DB::table('mf_course')->where('status','1')->orderBy('id', 'asc')->get();
$colleges = DB::table('mf_college')->where('status','1')->orderBy('city_id', 'asc')->get();
$partners = DB::table('mf_partner')->where('status','1')->orderBy('rank', 'asc')->get();
?>

<div class="subbanner_area home-slider" style="background-image:url({!! $page[0]->bannerimage && File::exists(public_path('uploads/'.$page[0]->bannerimage))?asset('/uploads/'.$page[0]->bannerimage):asset('/frontend/images/innerbanner1.jpg') !!});">
  <div class="container">
    <h2>{{ $page[0]->page_title }}</h2>
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
</div>

<!------- singin area start -------->
<section class="main_area singin_area">
  <div class="container">
  	{!! $page[0]->body !!}
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
            <h2>{!!$val->college_name!!} 
              - [{!!$val->short_name!!}], {{$collage_city}}</h2>
            <p><i class="fas fa-map-marker-alt"></i> {{$collage_city}}, {{$collage_state}}</p>
          </div>
          <div class="colleges_footer pt-0 pb-0 card-footer d-flex justify-content-between align-items-center"> <a href="{{url('college/'.$val->slug)}}" class="btn btn-link"> View All Course & Fees</a> <a href="{{url('college/'.$val->slug)}}" class="btn btn-primary"> Apply Now </a> </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!------- singin area stop --------> 

@include('frontend.footer')