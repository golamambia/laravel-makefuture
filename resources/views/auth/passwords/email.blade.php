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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email*" class="form-control @error('email') is-invalid @enderror" autocomplete="email" value="{{ old('email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="cmn-btn btn submit1">{{ __('Send Password Reset Link') }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@include('frontend.footer')
