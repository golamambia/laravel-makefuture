@include('frontend.header')
<?php
if ($course->bannerimage && File::exists(public_path('uploads/'.$course->bannerimage))) {
  $bannerimage = asset('/uploads/'.$course->bannerimage);
}else{
  $bannerimage = asset('/frontend/images/innerbanner1.jpg');
}
?>

<div class="subbanner_area" style="background-image:url({!! $bannerimage !!})">
  <div class="container">
    <h2>{!! $course->name !!}</h2>
  </div>
</div>


<section class="main_area singin_area">
  <div class="container">
    {!! $course->description !!}
  </div>
</section>

@include('frontend.footer')