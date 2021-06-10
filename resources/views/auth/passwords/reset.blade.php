@include('frontend.header')

<div class="subbanner_area" style="background-image:url({!! asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>Reset Password</h2>
  </div>
</div>


<div class="apply_form_area">
    <div class="container" style="max-width: 790px;">
        <div class="apply_form">
            <h2 class="heading">{{ __('Reset Password') }}</h2>
            <div class="form">
            <form method="POST" action="{{ route('password.update') }}" class="customvalidation">
                        @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email*" class="form-control @error('email') is-invalid @enderror" autocomplete="email" value="{{ old('email') }}" data-validation-engine="validate[required,custom[email]]">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password*" data-validation-engine="validate[required,minSize[8]]">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password*" data-validation-engine="validate[required,equals[password]]">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="cmn-btn btn submit1">{{ __('Password') }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@include('frontend.footer')
