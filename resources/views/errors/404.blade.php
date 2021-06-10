@include('frontend.header')

<div class="subbanner_area" style="background-image:url({!! asset('/frontend/images/innerbanner.jpg') !!})">
  <div class="container">
    <h2>Page Not Found</h2>
  </div>
</div>
<section class="main_area">
  <div class="container">
		<!-- <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">404</li>
		</ol> -->
		<div class="text-center">
			<!-- <div class="error404 center">404</div> -->
			<div class="heading-block nobottomborder">
				<h4>Oops! </h4>
				<span>The page you were looking for couldn’t be found.</span>
				<!-- <span>Try searching for the best match or browse the links below:</span> -->
			</div>
			<!-- <form action="{{ url('/search') }}" method="get" class="nobottommargin">
				<div class="input-group input-group-lg">
				
	                <input type="text" class="form-control" name="q" placeholder="Search for Pages...">
					<div class="input-group-append">
						<button class="btn btn-success" type="submit">Search</button>
					</div>

				</div>
			</form> -->
		</div>
    </div>
</section>

@include('frontend.footer')