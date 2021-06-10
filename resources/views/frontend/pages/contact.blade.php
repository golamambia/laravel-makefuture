@include('frontend.header')

<div class="subbanner_area" style="background-image:url({!! $page[0]->bannerimage && File::exists(public_path('uploads/'.$page[0]->bannerimage))?asset('/uploads/'.$page[0]->bannerimage):asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>{{ $page[0]->page_title }}</h2>
  </div>
</div>


<!-- Contact Us -->
<div class="contact-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="widget widget-contact-info">
          <div class="section-title">
            <h2>Let’s stay in touch!</h2>
          </div>
          <div class="media">
            <div class="item-icon"> <i class="fas fa-map-marker-alt"></i> </div>
            <div class="media-body space-md">
              <h4>Address</h4>
              <ul>
                <li>{!!config('site.address')!!}</li>
              </ul>
            </div>
          </div>
          <div class="media">
            <div class="item-icon"> <i class="fas fa-phone-alt"></i></div>
            <div class="media-body space-md">
              <h4>Phone:</h4>
              <ul>
                <li><a href="tel:{!!preg_replace('/\D+/', '', config('site.phone'))!!}">{!!config('site.phone')!!} </a> </li>
              </ul>
            </div>
          </div>
          <div class="media">
            <div class="item-icon"> <i class="fas fa-envelope"></i> </div>
            <div class="media-body space-md">
              <h4>Email</h4>
              <ul>
                <li><a href="mailto:{!!config('site.email')!!}">{!!config('site.email')!!}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="contact-item widget-contact-info">
          <div class="section-title">
            <h2>Leave a Reply</h2>
          </div>
            @if($errors->any())   
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            @foreach ($errors->all() as $error)
            {{ $error }}<br>
            @endforeach
            </div>
            @endif
                <form method="POST" action="{{ url('contact') }}" class="customvalidation">
                        @csrf
            <div class="row">
              <div class="col-sm-6 col-lg-6 pr-1">
                <div class="form-group has-error">
                  <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Name">
                </div>
              </div>
              <div class="col-sm-6 col-lg-6 pl-1">
                <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email">
                </div>
              </div>
              <div class="col-sm-12 col-lg-12">
                <div class="form-group has-error">
                  <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Phone">
                </div>
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <textarea name="message" class="form-control" id="message" cols="30" rows="3" required data-error="Write your message" placeholder="Message"></textarea>
                </div>
              </div>
              <div class="col-md-12 col-lg-12">
                <button type="submit" class="cmn-btn btn disabled submit1" style="pointer-events: all; cursor: pointer;">Submit</button>
                <div class="clearfix"></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Contact Us -->

<div class="map">
    {!! $page[0]->body !!}
</div>


@include('frontend.footer')