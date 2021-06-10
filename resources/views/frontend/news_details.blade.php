@include('frontend.header')
<?php
if ($news->bannerimage && File::exists(public_path('uploads/'.$news->bannerimage))) {
  $bannerimage = asset('/uploads/'.$news->bannerimage);
}elseif ($college->bannerimage && File::exists(public_path('uploads/'.$college->bannerimage))) {
  $bannerimage = asset('/uploads/'.$college->bannerimage);
}else{
  $bannerimage = asset('/frontend/images/innerbanner1.jpg');
}
?>

<div class="subbanner_area" style="background-image:url({!! $bannerimage !!})">
  <div class="container">
    <h2>{!! $news->title !!}</h2>
  </div>
</div>


<section class="main_area singin_area">
  <div class="container">
    {!! $news->description !!}
  </div>
</section>

@include('frontend.footer')