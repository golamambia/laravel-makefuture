@include('frontend.header')
<?php
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
$user = currentUserDetails();
?>

<div class="subbanner_area" style="background-image:url({!! asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>Payment</h2>
  </div>
</div>


<!---application form start-->
<div class="apply_form_area">
  <div class="container">
    <div class="apply_form">
      <h2 class="heading">Card information</h2>
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
                <form method="POST" action="{{ url('payment') }}" class="customvalidation" enctype="multipart/form-data">
                        @csrf
                  <input type="hidden" name="applyform_id" value="{{$list->id}}">
        <div class="row">
          <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="row">
              <div class="col-lg-12">
                <h3>Pay securely using a card: </h3>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="form-group">
                      <label>Card number <span>*</span></label>
                      <input type="text" name="card_no" placeholder=".... .... .... ...." class="form-control" id="card_no" data-validation-engine="validate[required]" value="4242-4242-4242-4242">
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                      <label>Expiration (MM/YY) <span>*</span></label>
                      <input type="text" name="exp" placeholder="MM / YY" class="form-control" minlength="5" maxlength="5" id="exp" data-validation-engine="validate[required]" value="11/23">
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                      <label>Card security code <span>*</span></label>
                      <input type="password" name="cvv" placeholder="CVV" class="form-control" minlength="3" maxlength="3" data-validation-engine="validate[required]" value="123">
                  </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <h3>Your Order</h3>
            <div class="totalTab">
                <div class="list">State: <strong>{!! get_field_value('mf_state', 'name', 'id', $list->state_id)!!}</strong></div>
                <div class="list">College name: <strong>{!! get_field_value('mf_college', 'college_name', 'id', $list->college_id)!!}</strong></div>
                <div class="list">Academic Year: <strong>{!! $list->academic_year!!}</strong></div>
                <div class="list">Course: <strong>{!! get_field_value('mf_course', 'name', 'id', $list->course_id)!!}</strong></div>
                <div class="total">Total: <strong>{!!$currency_with_icon_array[$list->currency]!!}{!! $list->price !!}</strong></div>
            </div>
            <div class="checkoutTab">
                <div class="checkoutInner">
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 checkTxt">
                          <p>Your personal data will be held securely in accordance with our <a href="{!! url(get_field_value('pages', 'slug', 'id', 10)) !!}">Terms & Conditions</a>.</p>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12">
                          <button type="submit" class="btn btn-primary">Pay</button>
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!---application form end--> 

@section('more-scripts')

<script type="text/javascript">
$(document).ready(function(){

    //For Card Number formatted input
    var cardNum = document.getElementById('card_no');
    cardNum.onkeyup = function (e) {
        if (this.value == this.lastValue) return;
        var caretPosition = this.selectionStart;
        var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
        var parts = [];

        for (var i = 0, len = sanitizedValue.length; i < len; i +=4) { 
            parts.push(sanitizedValue.substring(i, i + 4)); 
        } 
        for (var i=caretPosition - 1; i>= 0; i--) {
            var c = this.value[i];
            if (c < '0' || c> '9') {
                caretPosition--;
            }
        }
        caretPosition += Math.floor(caretPosition / 4);

        this.value = this.lastValue = parts.join('-');
        this.selectionStart = this.selectionEnd = caretPosition;
    }

    //For Date formatted input
    var expDate = document.getElementById('exp');
    expDate.onkeyup = function (e) {
        if (this.value == this.lastValue) return;
        var caretPosition = this.selectionStart;
        var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
        var parts = [];

        for (var i = 0, len = sanitizedValue.length; i < len; i +=2) { 
            parts.push(sanitizedValue.substring(i, i + 2)); 
        } 
        for (var i=caretPosition - 1; i>= 0; i--) {
            var c = this.value[i];
            if (c < '0' || c> '9') {
                caretPosition--;
            }
        }
        caretPosition += Math.floor(caretPosition / 2);

        this.value = this.lastValue = parts.join('/');
        this.selectionStart = this.selectionEnd = caretPosition;
    }

    // Radio button
    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

});
</script>
@stop


@include('frontend.footer')