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
						<li class="breadcrumb-item active" aria-current="page">Profile</li>
					</ol>
				</div>
			</nav>

			<h1>Profile</h1>
		</div>
	</div>
    <div class="container my-5">
        <div class="row user-profile">
            <div class="col-md-3">
                @include('frontend.profile.user_menu')
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <div class="">
                    <h3 class="text-center"> Your can update your profile from here</h3>
                    <div class="card-body">
                        <form class="" method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="name" value="{{ old('name') ?? $user->name}}" >
                                @error('name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="email" name="email" value="{{old('email') ?? $user->email}}" >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                              </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="phone">+880</span>
                                    </div>
                                    <input type="text" class="form-control unicase-form-control text-input"  id="phone" name="phone" value="{{old('phone') ?? $user->phone}}" >
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Profile Pic</label>
                                <input type="file" class="form-control unicase-form-control text-input"  id="phone" name="profile_photo_path" value="{{old('profile_photo_path') ?? $user->profile_photo_path}}" >
                                @error('profile_photo_path')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            

                            <div class="form-group">
                                <label class="info-title" for="">Referral Code</label>
                                <input type="text" class="form-control unicase-form-control text-input" id="referCode" value="{{ $user->refer_code }}" onclick="copyReferCode()" readonly>
                                <a href="javascript:;" onclick="copyReferCode()">Copy</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container --> 
</div>


<script>
    function copyReferCode() {
        // Get the input field
        let referCodeInput = document.getElementById("referCode");

        // Select the text in the input field
        referCodeInput.select();

        // Copy the selected text
        document.execCommand("copy");

        // Alert the copied text
        alert("Refer code copied: " + referCodeInput.value);
    }
</script>

@endsection



