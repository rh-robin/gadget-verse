@extends('frontend.main_master')

@section('content')

<div class="main">
    <div class="page-header">
		<div class="container d-flex flex-column align-items-center">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="demo4.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">
							My Account
						</li>
					</ol>
				</div>
			</nav>

			<h1>My Account</h1>
		</div>
	</div>
    <div class="container my-5">
        <div class="row user-profile">
            <div class="col-md-3 mb-2">
                @include('frontend.profile.user_menu')
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <h3 class="text-center"><span class="text-danger">Hi... </span>{{ Auth::user()->name }}.<strong> Welcome To Your Gadget Verse Profile</strong></h3>
            </div>
        </div>
    </div>
    <!-- /.container --> 
</div>

@endsection



