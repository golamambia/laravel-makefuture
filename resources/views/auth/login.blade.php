@include('frontend.header')

<div class="subbanner_area" style="background-image:url({!! asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>Login</h2>
  </div>
</div>

<div class="apply_form_area">
    <div class="container" style="max-width: 790px;">
        <div class="apply_form">
            <h2 class="heading">Login</h2>
            <div class="form">
            <form method="POST" action="{{ route('login') }}">
                        @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email*" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" value="{{ old('email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password*">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input form-check-input" type="checkbox" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck">Keep me logged in</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgotPass">Forgot Password?</a>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="cmn-btn btn submit1">Login</button>
                </div>
                <div class="text-center">
                    <p>Don’t have an account? <a href="{{ route('register') }}">Register Now!</a></p>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


@include('frontend.footer')

