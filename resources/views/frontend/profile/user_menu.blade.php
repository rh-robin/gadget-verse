@php
    $id = Auth::user()->id;
    $user = App\Models\User::find($id);
@endphp

<img src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/noimage.jpg') }}" alt="" class="card-img-top mb-2" style="border-radius: 50%; height: auto; width: 100%">
<ul class="list-group list-group-flush">
    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
    <a href="{{ route('user.orders') }}" class="btn btn-primary btn-sm btn-block">My Orders</a>
    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
    <a href="{{ route('user.changePassword') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
</ul>