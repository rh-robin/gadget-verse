@extends('frontend.main_master')

@section('content')

<div class="main">
    <div class="page-header">
		<div class="container d-flex flex-column align-items-center">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item" >My Account</li>
						<li class="breadcrumb-item active" aria-current="page">Change Password</li> 
					</ol>
				</div>
			</nav>

			<h1>Change Your Password</h1>
		</div>
	</div>
    <div class="container my-5">
        <div class="row user-profile">
            <div class="col-md-3">
                <img src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/noimage.jpg') }}" alt="" class="card-img-top mb-2" style="border-radius: 50%; height: auto; width: 100%">
                <ul class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('user.changePassword') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <div class="">
                    <h3 class="text-center">Change Your Password</h3>

                    {{-- change password form --}}
                    <div class="card-body">
                        <form class="" method="POST" action="{{ route('user.updatePassword') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="current_password">Current Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"  id="current_password" name="oldpassword" value="" >
                                @error('oldpassword')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">New Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"  id="password" name="password" value="" >
                                @error('password')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"  id="password_confirmation" name="password_confirmation" value="" >
                                @error('password_confirmation')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                            </div>
                        </form>
                    </div>  {{-- end card-body --}}
                </div>
            </div>
        </div>
    </div>
    <!-- /.container --> 
</div>

@endsection



