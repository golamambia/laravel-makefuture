@include('frontend.header')

<div class="subbanner_area" style="background-image:url({!! asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>Register</h2>
  </div>
</div>


<div class="apply_form_area">
    <div class="container" style="max-width: 790px;">
        <div class="apply_form">
            <h2 class="heading">{{ __('Sign up as a franchise') }}</h2>
            <div class="form">
            <form method="POST" action="{{ route('register') }}" class="customvalidation">
                        @csrf
                <input type="hidden" name="role_id" value="2">
                <div class="form-group">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="First Name*" autocomplete="first_name" data-validation-engine="validate[required]" autofocus>

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" data-validation-engine="validate[required]" placeholder="Surname*" autocomplete="last_name" autofocus>

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email*" data-validation-engine="validate[required,custom[email]]" autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password*" data-validation-engine="validate[required,custom[password]]" autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p>Min 8 character</p>
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password*" data-validation-engine="validate[required,equals[password]]" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="address" placeholder="Address">{{ old('address') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="aadhaar_number" value="{{ old('aadhaar_number') }}" placeholder="Aadhaar Number">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="logged" required>
                        <label class="custom-control-label" for="customCheck">I agree with the <a href="{{ url('/terms') }}" target="_blank">Terms & Conditions</a>.</label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="cmn-btn btn submit1">Register</button>
                </div>
                <div class="text-center">
                    <p>Already have an account? <a href="{{ route('login') }}">Login!</a></p>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@include('frontend.footer')
