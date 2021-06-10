@include('frontend.header')

<div class="subbanner_area" style="background-image:url({!! asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>Confirm Password</h2>
  </div>
</div>


<div class="apply_form_area">
    <div class="container" style="max-width: 790px;">
        <div class="apply_form">
            <h2 class="heading">{{ __('Confirm Password') }}</h2>
            <div class="form">
            <form method="POST" action="{{ route('verification.notice') }}">
                        @csrf
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password*">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="cmn-btn btn submit1">{{ __('Confirm Password') }}</button>
                </div>
                <div class="text-center">
                    <p><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></p>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@include('frontend.footer')

