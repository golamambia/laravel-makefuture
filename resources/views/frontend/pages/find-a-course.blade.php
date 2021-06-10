@include('frontend.header')
<?php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$course_type_array = unserialize(Course_Type_Array); 
$course_subtype_array = unserialize(Course_Subtype_Array); 
$states = DB::table('mf_state')->where('status','1')->orderBy('id', 'asc')->get();
$cities = DB::table('mf_city')->where('status','1')->orderBy('id', 'asc')->get();

$type = Request()->type;
$subtype = Request()->subtype;
$where = "status='1' ";
if($type>0)
{
  $where .= " and course_type='".$type."' ";
}
if($subtype>0)
{
  $where .= " and course_subtype='".$subtype."' ";
}
$courses = DB::table('mf_course')->whereRaw($where)->orderBy('name', 'asc')->get();


$colleges = DB::table('mf_college')->where('status','1')->orderBy('city_id', 'asc')->get();
$partners = DB::table('mf_partner')->where('status','1')->orderBy('rank', 'asc')->get();
?>

<div class="subbanner_area" style="background-image:url({!! $page[0]->bannerimage && File::exists(public_path('uploads/'.$page[0]->bannerimage))?asset('/uploads/'.$page[0]->bannerimage):asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>{{ $page[0]->page_title }}</h2>
  </div>
</div>


<section class="main_area singin_area">
  <div class="container">
    {!! $page[0]->body !!}

    <div class="row row-7">
      <div class="col-lg-3">
        <div class="filter_area">

          <div class="filter_box">
            <!-- <h3>Courses</h3> -->
            <div id="accordion">

              @foreach($course_type_array as $key => $value)
              <div class="card">
                <div class="card-header" id="heading-{{ $key }}">
                  <h5 class="mb-0">
                    <a @if($key>1) role="button" data-toggle="collapse" href="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapse-{{ $key }}" @else href="{{url('/'.$page[0]->slug.'/?type='.$key)}}" @endif>
                      {{ $value }}
                    </a>
                  </h5>
                </div>
                @if($key>1)
                <div id="collapse-{{ $key }}" class="collapse {!! $type==$key?'show':'' !!}" data-parent="#accordion" aria-labelledby="heading-{{ $key }}">
                  <div class="card-body">
                    <ul>
                      @foreach($course_subtype_array as $key1 => $value1)
                      <li class="{!! $subtype==$key1?'active':'' !!}"><a href="{{url('/'.$page[0]->slug.'/?type='.$key.'&subtype='.$key1)}}">{{ $value1 }}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                @endif
              </div>
              @endforeach 

            </div>
          </div> 

        </div>
      </div>
      <div class="col-lg-9">
        <div class="row row-5">
          @if ($courses->count() > 0)
          @foreach($courses as $val)
          <div class="col-lg-4 col-md-6 col-sm-6 col-12"> <!-- <a href="{{url('/search?course='.$val->id)}}"> --><a href="{{url('/course/'.$val->slug)}}">
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
          @else

          <div class="col-lg-12">
            <h5>No courses were found matching your selection!</h5>
          </div>

          @endif
        </div>
      </div>
    </div>

  </div>
</section>

@include('frontend.footer')