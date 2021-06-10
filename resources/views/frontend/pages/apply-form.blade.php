@include('frontend.header')
<?php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$states = DB::table('mf_state')->where('status','1')->orderBy('id', 'asc')->get();
$cities = DB::table('mf_city')->where('status','1')->orderBy('id', 'asc')->get();
$courses = DB::table('mf_course')->where('status','1')->orderBy('id', 'asc')->get();
$colleges = DB::table('mf_college')->where('status','1')->orderBy('city_id', 'asc')->get();

$state_id = 0;
if (old('state_id')) {
  $state_id = old('state_id');
}elseif (Request()->state_id) {
  $state_id = Request()->state_id;
}
$college_id = 0;
if (old('college_id')) {
  $college_id = old('college_id');
}elseif (Request()->college_id) {
  $college_id = Request()->college_id;
}
$academic_year = 0;
if (old('academic_year')) {
  $academic_year = old('academic_year');
}elseif (Request()->academic_year) {
  $academic_year = Request()->academic_year;
}

$email = '';
if (old('email')) {
  $email = old('email');
}elseif (Auth::check()) {
  $user = currentUserDetails();
  if ($user->role_id=='3') {
    $email = $user->email;
  }  
}
?>

<div class="subbanner_area" style="background-image:url({!! $page[0]->bannerimage && File::exists(public_path('uploads/'.$page[0]->bannerimage))?asset('/uploads/'.$page[0]->bannerimage):asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>{{ $page[0]->page_title }}</h2>
  </div>
</div>


<!---application form start-->
<div class="apply_form_area">
  <div class="container">
    {!! $page[0]->body !!}
    <div class="apply_form">
      <h2 class="heading">student information</h2>
      <div class="form">
            @if($errors->any())   
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            @foreach ($errors->all() as $error)
            {{ $error }}<br>
            @endforeach
            </div>
            @endif
                <form method="POST" action="{{ url('apply-form') }}" class="customvalidation" enctype="multipart/form-data">
                        @csrf
        <div class="row">
          <div class="col-lg-8">
            <div class="form-group">
              <label>Student Full Name</label>
              <input type="text" class="form-control" placeholder="Student Full Name" name="name" value="{{ old('name') }}" data-validation-engine="validate[required]">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>DOB</label>
              <input type="date" class="form-control" placeholder="" name="dob" value="{{ old('dob') }}">
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label>Father's Name</label>
              <input type="text" class="form-control" placeholder="Father's Name" name="father_name" value="{{ old('father_name') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Father's Mobile</label>
              <input type="text" class="form-control" placeholder="Mobile" name="father_mobile" value="{{ old('father_mobile') }}">
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label>Mother's Name</label>
              <input type="text" class="form-control" placeholder="Mother's Name" name="mother_name" value="{{ old('mother_name') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Mother's Mobile</label>
              <input type="text" class="form-control" placeholder="Mobile" name="mother_mobile" value="{{ old('mother_mobile') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Nationality</label>
              <input type="text" class="form-control" placeholder="Nationality" name="nationality" value="{{ old('nationality') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Caste</label>
              <input type="text" class="form-control" placeholder="Caste" name="cast" value="{{ old('cast') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Sex</label>
              <select class="form-control" name="gender">
                <option value="Male" {!! old('gender')=='Male'?'selected':'' !!}>Male</option>
                <option value="Female" {!! old('gender')=='Female'?'selected':'' !!}>Female</option>
              </select>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label>Nationality Citizenship / Aadhaar No.</label>
              <input type="text" class="form-control" placeholder="Nationality Citizenship / Aadhaar No." name="citizenship" value="{{ old('citizenship') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Student's Mobile</label>
              <input type="text" class="form-control" placeholder="Mobile" name="student_mobile" value="{{ old('student_mobile') }}">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>Email Address:</label>
              <input type="text" class="form-control" placeholder="Email" name="email" value="{{ $email }}" data-validation-engine="validate[required,custom[email]]">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Parmanent Address:</label>
              <textarea class="form-control" placeholder="Parmanent Address" name="parmanent_address">{{ old('parmanent_address') }}</textarea>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Local Guardian Address:</label>
              <textarea class="form-control" placeholder="Local Guardian Address" name="local_address">{{ old('local_address') }}</textarea>
            </div>
          </div>
          <div class="col-lg-12">
            <h3>Course Apply For:</h3>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>State</label>
              <select class="form-control" name="state_id" id="state_id" data-validation-engine="validate[required]">
                <option value="">Select</option>
                @foreach($states as $val)
                <option value="{!! $val->id !!}" {!! $state_id==$val->id?'selected':'' !!}>{!! $val->name !!}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>College</label>
              <select class="form-control" name="college_id" id="college_id" data-validation-engine="validate[required]">
                <option value="">Select</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Chose Academic Year</label>
              <select class="form-control" name="academic_year">
                <option value="">Select</option>
                @for($i=date('Y');$i <= date('Y')+1; $i++)
                <option value="{!! $i !!}" {!! $academic_year==$i?'selected':'' !!}>{!! $i !!}</option>
                @endfor
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <h3>Academic Details: <button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button></h3>
          </div>
          <div class="academic_details"></div>

          @if (!Auth::check())
          <div class="col-lg-12">
            <h3>Referral Details: </h3>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>Referral code</label>
              <input type="text" class="form-control" placeholder="Have a Referral code?" name="referral_code" value="{{ old('referral_code') }}">
            </div>
          </div>
          @endif

          <div class="col-lg-12">
            <h3>Fee Details: </h3>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Course</label>
              <select class="form-control" name="course_id" id="course_id" data-validation-engine="validate[required]">
                <option value="">Select</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6">
            <label>&nbsp;</label><br>
            <strong>{{$currency_with_icon_array[$_SESSION['currency']]}}</strong><strong class="price">0.00</strong>
          </div>

          <div class="col-lg-12">
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck" value="1" name="aggrement" required>
                    <label class="custom-control-label" for="customCheck">I agree with the <a href="{{ url('/terms') }}" target="_blank">Terms & Conditions</a>.</label>
                </div>
            </div>
          </div>

          <div class="col-lg-12">
            <button type="submit" class="cmn-btn btn disabled submit1" style="pointer-events: all; cursor: pointer;">Submit</button>
          </div>
        </div>
        <input type="hidden" name="price" value="" id="price">
        </form>
      </div>
    </div>
  </div>
</div>
<!---application form end--> 

<!-- Copy Fields -->
<div class="copy hide">
  <div class="row control-group">
      <div class="col-md-4"> 
        <div class="form-group">
          <label>Subject Name / Course Details:</label>
          <input type="text" class="form-control" placeholder="Subject Name / Course Details" name="subject_name[]" value="" data-validation-engine="validate[required]">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Marks Obtain:</label>
          <input type="text" class="form-control" placeholder="Marks Obtain" name="marks[]" value="">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Percentage:</label>
          <input type="text" class="form-control" placeholder="Percentage" name="percentage[]" value="">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Upload Documents:</label>
          <input type="file" class="form-control" name="document[]">
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label>&nbsp;</label><br>
          <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
        </div>
      </div>
  </div>
</div>

@section('more-scripts')

<script>
$(function(){
  $('.copy').hide();
  //$(".add-more").click(function(){
  $("body").on("click",".add-more",function(){ 
      //$('.copy').show();
      var html = $(".copy").html();
      $(".academic_details").append(html);
  });
  $("body").on("click",".remove",function(){ 
      $(this).parents(".control-group").remove();
  });
});
</script>

<script type="text/javascript">
function state_change()
{
  var state_id = $("#state_id").val(); 
  var college_id = '{{$college_id}}';
  var data = {'state_id' : state_id,'college_id':college_id};

  $.ajax({
    type : 'get',
    url : '{{url("ajax/get-college")}}',
    data : data,
    dataType : 'json',
    beforeSend : function(){
      //$("#loading").show();
    },
    success : function(result){
      //$("#loading").hide();
      console.log(result);
      $("#college_id").empty().html(result);
      college_change();
    }
  }); 
}

function college_change()
{
  var college_id = $("#college_id").val(); 
  var course_id = '{{old("course_id")}}';
  var data = {'college_id' : college_id,'course_id':course_id};

  $.ajax({
    type : 'get',
    url : '{{url("ajax/get-college-course")}}',
    data : data,
    dataType : 'json',
    beforeSend : function(){
      //$("#loading").show();
    },
    success : function(result){
      //$("#loading").hide();
      console.log(result);
      $("#course_id").empty().html(result);
      course_change();
    }
  }); 
}

function course_change()
{
    var price = $('#course_id').find(':selected').data('price'); //alert(price);
    if (price>0) {
      $("#price").val(price);
      $(".price").html(price);
    }else{
      $("#price").val('');
      $(".price").html('0.00');
    } 
}

$(document).ready(function(){
  state_change();
  college_change();
  $('#state_id').change(function(){
    state_change();
  });
  $('#college_id').change(function(){
    college_change();
  });
  $('#course_id').change(function(){   
    course_change();
  });
});
</script>
@stop


@include('frontend.footer')