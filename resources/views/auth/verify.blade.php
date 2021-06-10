@include('frontend.header')
@php
$banner_url = asset('/frontend/images/innerbanner2.jpg');
@endphp

<div class="subbanner_area" style="background-image:url({!! asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>Verify Email</h2>
  </div>
</div>

<div class="apply_form_area">
    <div class="container" style="max-width: 790px;">
        <div class="apply_form">
            <div class="form">
            <h2 class="heading">{{ __('Verify Your Email Address') }}</h2>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="cmn-btn btn submit1">{{ __('click here to request another') }}</button>.
            </form>
        </div>
        </div>
    </div>
</div>

@include('frontend.footer')

