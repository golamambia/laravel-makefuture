@include('frontend.header')
<div class="subbanner_area" style="background-image:url({!! $page[0]->bannerimage && File::exists(public_path('uploads/'.$page[0]->bannerimage))?asset('/uploads/'.$page[0]->bannerimage):asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>{{ $page[0]->page_title }}</h2>
  </div>
</div>

<section class="main_area singin_area">
  <div class="container">
        {!! $page[0]->body !!}
  </div>
</section>
@include('frontend.footer')