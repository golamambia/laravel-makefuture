@include('frontend.header')

<?php
$partners = DB::table('mf_partner')->where('status','1')->orderBy('rank', 'asc')->get();
?>
<div class="subbanner_area" style="background-image:url({!! $page[0]->bannerimage && File::exists(public_path('uploads/'.$page[0]->bannerimage))?asset('/uploads/'.$page[0]->bannerimage):asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>{{ $page[0]->page_title }}</h2>
  </div>
</div>

@foreach($extra_data as $val)
  @if($val->type==2)
<!---About Us start-->
<div class="about_us clearfix">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-5">
        @if($val->image2 && File::exists(public_path('uploads/'.$val->image2)) )<div class="about_thumlbe mt-0"><img src="{{ asset('/uploads/'.$val->image2) }}" alt="">@if($val->image && File::exists(public_path('uploads/'.$val->image)) )<div class="aboutimg"><img src="{{ asset('/uploads/'.$val->image) }}" alt=" "></div>@endif</div>@endif
      </div>
      <div class="col-lg-7 col-md-7 pl-5">
        <div class="about_textbox">
          <h2>{!! $val->title !!}</h2>
          {!! $val->body !!}
        </div>
      </div>
    </div>
  </div>
</div>
<!---About Us end--> 
  @endif
@endforeach

@foreach($extra_data as $val)
  @if($val->type==3)
<!---Our Mission start-->
<div class="ourmission">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-7 atxt pr-4">
        <div class="about_textbox">
          <h2>{!! $val->title !!}</h2>
          {!! $val->body !!}
        </div>
      </div>
      <div class="col-lg-5 col-md-5 aimg">
         @if($val->image && File::exists(public_path('uploads/'.$val->image)) )<div class="about_thumlbe"> <img src="{{ asset('/uploads/'.$val->image) }}" alt=""> </div>@endif
      </div>
    </div>
  </div>
</div>
<!---Our Mission end--> 
  @endif
@endforeach

@foreach($extra_data as $val)
  @if($val->type==4)
<!---Our Vision start-->
<div class="ourvision">
  <div class="row m-0">
    <div class="col-lg-6 col-md-6 pl-0 pr-4">
      <div class="medical-box-layout5">
        <div class="medical-box-img">
          <div class="item-img">@if($val->image && File::exists(public_path('uploads/'.$val->image)) )<img src="{{ asset('/uploads/'.$val->image) }}" alt=" ">@endif
            @if($val->btn_url) <div class="item-icon"> <a class="play-btn"  data-fancybox href="{{ $val->btn_url }}"> <i class="fa fa-play" aria-hidden="true"></i></a> </div>@endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 pl-5 pr-5">
      <div class="about_textbox">
        <h2>{!! $val->title !!}</h2>
        {!! $val->body !!}
      </div>
    </div>
  </div>
</div>
<!---Our Vision end--> 
  @endif
@endforeach

<!---Our Latest Projects -->
<div class="ourgrally_area">
  <div class="container">
@foreach($extra_data as $val)
  @if($val->type==5)
    <h2>{!! $val->title !!}</h2>
    <div class="container_p">{!! $val->body !!}</div>
  @endif
@endforeach
    <div class="card-columns">
        <?php $count=0;
        foreach($extra_data as $val) :
            if($val->type==7 && $val->image && File::exists(public_path('uploads/'.$val->image))) :
                $count++; 
        ?>
      <div class="card card_{{$count}}"> <img src="{{ asset('/uploads/'.$val->image) }}" alt=""> <a href="{{ asset('/uploads/'.$val->image) }}" data-fancybox="images" class="overlay"> <i class="fa fa-search-plus" aria-hidden="true"></i> </a> </div>
        <?php 
          endif;
        endforeach;
        ?>
    </div>
  </div>
</div>

@foreach($extra_data as $val)
  @if($val->type==6)
<!--Our Partners start-->
<div class="ourpartners_area" style="background-image: url({{ asset('/frontend/images/ourpanterbg.jpg') }});">
  <div class="container">
    <h2>{!! $val->title !!}</h2>
    <div class="container_p">{!! $val->body !!}</div>
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
  @endif
@endforeach

@section('more-scripts')

<script type="text/javascript">
$(window).ready (function () {
$('[data-fancybox]').fancybox({
    youtube : {
        controls : 0,
        showinfo : 0
    },
    vimeo : {
        color : 'f00'
    }
});
});
</script>
@stop

@include('frontend.footer')