@include('frontend.header')
<?php
$states = DB::table('mf_state')->where('status','1')->orderBy('id', 'asc')->get();
$cities = DB::table('mf_city')->where('status','1')->orderBy('id', 'asc')->get();
$courses = DB::table('mf_course')->where('status','1')->orderBy('id', 'asc')->get();
?>

<div class="subbanner_area" style="background-image:url({!! $page[0]->bannerimage && File::exists(public_path('uploads/'.$page[0]->bannerimage))?asset('/uploads/'.$page[0]->bannerimage):asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>{{ $page[0]->page_title }}</h2>
  </div>
</div>
<!------- singin area start -------->
<section class="main_area">
  <div class="container">
    <div class="blog_area">
    @foreach($extra_data as $val)
      @if($val->type==3)
      <div class="blogmain_box clearfix">
        <div class="blog_imgthumblearea">
          @if($val->image && File::exists(public_path('uploads/'.$val->image)) )<div class="img_thumble" style="background-image:url({{ asset('/uploads/'.$val->image) }})"></div>@endif
        </div>
        <div class="blog_contantarea justify-content-end">
          <div class="valignCenter">
            @if($val->image2 && File::exists(public_path('uploads/'.$val->image2)) )<div class="icon"><img src="{{ asset('/uploads/'.$val->image2) }}" alt=""></div>@endif
            <h2>{!! $val->title !!}</h2>
            {!! $val->body !!}
          </div>
        </div>
      </div>
      @endif
    @endforeach
    </div>
  </div>
</section>
<!------- singin area stop --------> 

<!---Enquiry -->
<div class="enquiry" style="background-image:url({{ asset('/frontend/images/enquiry-bg.jpg') }})">
  <div class="container">
    @foreach($extra_data as $val)
      @if($val->type==5)
    <h2>{!! $val->title !!}</h2>
    <div class="container_p">{!! $val->body !!}</div>
      @endif
    @endforeach
    @if($errors->any())   
    <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    @foreach ($errors->all() as $error)
    {{ $error }}<br>
    @endforeach
    </div>
    @endif
    <form method="POST" action="{{ url('enquiry') }}" class="customvalidation">
        @csrf
      <div class="row">
        <div class="col-lg-6 pr-2">
          <div class="form-group">
            <input type="text" class="form-control fild"  aria-describedby="emailHelp" placeholder="First Name" name="fname" value="{{ old('fname') }}" data-validation-engine="validate[required]">
          </div>
        </div>
        <div class="col-lg-6 pl-2">
          <div class="form-group">
            <input type="text" class="form-control fild" aria-describedby="emailHelp" placeholder="Last Name" name="lame" value="{{ old('lame') }}" data-validation-engine="validate[required]">
          </div>
        </div>
        <div class="col-lg-6 pr-2">
          <div class="form-group">
            <input type="text" class="form-control fild"  aria-describedby="emailHelp" placeholder="Email" name="email" value="{{ old('email') }}" data-validation-engine="validate[required,custom[email]]">
          </div>
        </div>
        <div class="col-lg-6 pl-2">
          <div class="form-group">
            <input type="number" class="form-control fild"  aria-describedby="emailHelp" placeholder="Phone" name="phone" value="{{ old('phone') }}">
          </div>
        </div>
        <div class="col-lg-4 pr-2">
          <div class="form-group">
            <input type="text" class="form-control fild" aria-describedby="emailHelp" placeholder="Subject" name="subject" value="{{ old('subject') }}">
          </div>
        </div>
        <div class="col-lg-4 pl-2 pr-2">
          <div class="form-group">
            <select class="form-control fild" id="exampleFormControlSelect1" name="state">
              <option value="">State</option>
              @foreach($states as $val)
              <option value="{!! $val->name !!}">{!! $val->name !!}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-lg-4 pl-2">
          <div class="form-group">
            <select class="form-control fild" id="exampleFormControlSelect2" name="course">
              <option value="">Course</option>
              @foreach($courses as $val)
              <option value="{!! $val->name !!}">{!! $val->name !!}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <textarea type="text" class="form-control fild1" placeholder="Message" name="message">{{ old('message') }}</textarea>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary submit">Submit</button>
    </form>
  </div>
</div>
<!---Enquiry -->

@include('frontend.footer')
