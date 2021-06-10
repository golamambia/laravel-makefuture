@include('frontend.header')
@include('frontend.header-common')
<div class="innerBanner">
    <h1>{{ $page[0]->page_title }}</h1>
</div>
<div class="bodyContent">
    <div class="container" style="max-width: 980px;">
        {!! $page[0]->body !!}
    </div>
</div>
@include('frontend.footer')