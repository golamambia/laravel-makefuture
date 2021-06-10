@include('frontend.header')
<?php
if ($faculty->bannerimage && File::exists(public_path('uploads/'.$faculty->bannerimage))) {
  $bannerimage = asset('/uploads/'.$faculty->bannerimage);
}elseif ($college->bannerimage && File::exists(public_path('uploads/'.$college->bannerimage))) {
  $bannerimage = asset('/uploads/'.$college->bannerimage);
}else{
  $bannerimage = asset('/frontend/images/innerbanner1.jpg');
}
?>

<div class="subbanner_area" style="background-image:url({!! $bannerimage !!})">
  <div class="container">
    <h2>{!! $faculty->title !!}</h2>
    @if($faculty->designation)<h3>{!! $faculty->designation !!}</h3>@endif
  </div>
</div>


<section class="main_area singin_area">
  <div class="container">
    {!! $faculty->description !!}
  </div>
</section>

@include('frontend.footer')