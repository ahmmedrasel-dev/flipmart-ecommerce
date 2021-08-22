@extends('frontend.front-master')
@section('content')
<div class="container">
    <div class="sign-in-page">
        <div class="card-body">
            <div class="row">
                <div class="col col-md-2">
                    <div class="card">
                        @php
                            $userid = Auth::user()->id;
                            $user = App\Models\User::findOrFail($userid);
                        @endphp
                        <div class="card-body">
                            <img class="img-fluid img-thumbnail" src="{{ ( !empty($user->profile_photo_path)) ?  url('front-assets/images/profile_photo/'.$user->profile_photo_path): url('backend-assets/profile_photo/default/default_img.png') }}" alt="" style="border-radius: 50%">
                            <ul class="list-group" style="margin-top:20px">
                                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
                                <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">Profile Update</a>
                                <a href="{{ route('user.password.edit') }}" class="list-group-item list-group-item-action">Change Password</a>
                                <a href="{{ route('user.logout') }}" class="list-group-item list-group-item-danger">Logout</a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <h3 class="text-center">
                            <span class="text-danger">Hi....</span><strong>{{ Auth::user()->name }}</strong> Welcome To Flipmart Online Shop!
                        </h3>
                    </div>
                </div> <!-- // end col md 6 -->
            </div> <!-- // end row -->
        </div>
    </div>
</div>
@endsection
